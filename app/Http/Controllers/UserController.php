<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Record;
use App\Models\Task;
use App\Models\Answer;
use App\Models\Course;
use App\Models\GlobalCategory;
use App\Models\SubCategory;
use App\Models\Role;
use App\Models\Attendance;
use App\Models\Schedule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function registration(Request $request) {

        $request->validate([
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:5',
            'name' => 'required|string|min:2',
            'surname' => 'required|string|min:2',
            'patronymic' => 'required|string|min:2',
            'role' => 'required',
        ]);

        $userData = $request->all();

        $user = new User();
        $user->email = $userData['email'];
        $user->password = bcrypt($userData['password']);
        $user->name = $userData['name'];
        $user->photo_url = 'uploads/user-1.png';
        $user->surname = $userData['surname'];
        $user->patronymic = $userData['patronymic'];
        $user->role_id = $userData['role'];
        $user->description = 'Описание профиля';
        $user->reg_date = Carbon::now();

        $user->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect('/');
    }

    public function logout(Request $request) {
        $user = Auth::user();

        if ($user && $user->login_time) {
            $logoutTime = Carbon::now();
            $usageTime = $logoutTime->diffInSeconds($user->login_time); // Разница в секундах

            // Суммируем общее время использования
            $user->usege_time += $usageTime;
            $user->save();
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function authorization(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|string|exists:users',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();

        if (Auth::attempt($credentials)) {
            // Фиксируем вход в таблице visits
            DB::table('visits')->insert([
                'user_id' => $user->id,
                'login_time' => now(),
            ]);

            // Обновляем поле last_login в users
            $user->last_login = now();
            $user->login_time = now();
            $user->save();

            $request->session()->regenerate();
            return redirect()->route('main-page');
        }

        return back()->withErrors(['password' => 'Неверный пароль']);
    }




    public function password(Request $request) {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', trans($status));
        }

        return back()->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Данный email не зарегестрирован.'
            ]);
    }

    public function reset(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:5',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' =>  bcrypt($request->password),
                    'remember_token' => Str::random(60)
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login-page')->with('status', trans($status));
        }
    }

    public function edit(Request $request) {

        if(Auth::user()->role_id == 2) {
            $request->validate([
                'name' => 'required|string|min:2',
                'surname' => 'required|string|min:2',
                'patronymic' => 'required|string|min:2',
                'image' => 'sometimes|nullable|mimes:jpeg,png',
                'description' => 'required|string|min:2',
            ]);

            $id = Auth::user()->id;
            $photo = Auth::user()->photo_url;

            $user = User::find($id);
            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->patronymic = $request->input('patronymic');
            $user->description = $request->input('description');
            if ($request->file('image') == null) {
                $user->photo_url = $photo;
            }else{
                $user->photo_url = $request->file('image')->store('uploads', 'public');
            }
            $user->save();
        } else {
            $request->validate([
                'name' => 'required|string|min:2',
                'surname' => 'required|string|min:2',
                'patronymic' => 'required|string|min:2',
                'image' => 'sometimes|nullable|mimes:jpeg,png',
                'description' => 'required|string|min:2',
                'education' => 'required|string|min:2',
                'direction' => 'required|string|min:2',
            ]);

            $id = Auth::user()->id;
            $photo = Auth::user()->photo_url;

            $user = User::find($id);
            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->patronymic = $request->input('patronymic');
            $user->description = $request->input('description');
            $user->education = $request->input('education');
            $user->direction = $request->input('direction');
            if ($request->file('image') == null) {
                $user->photo_url = $photo;
            }else{
                $user->photo_url = $request->file('image')->store('uploads', 'public');
            }
        $user->save();

        }

        return redirect()->route('profile-page');
    }

    public function user_delete($id) {
        DB::transaction(function () use ($id) {
            $user = User::find($id);

            if (!$user) {
                return redirect()->route('all-users-page')->with('error', 'Пользователь не найден');
            }

            // Найти все курсы, которые ведёт пользователь
            $courseIds = Course::where('teacher_id', $id)->pluck('id');

            if ($courseIds->isNotEmpty()) {
                // Найти связанные записи в расписании
                $scheduleIds = Schedule::whereIn('course_id', $courseIds)->pluck('id');

                if ($scheduleIds->isNotEmpty()) {
                    // Удалить посещаемость, связанную с расписанием
                    Attendance::whereIn('schedule_id', $scheduleIds)->delete();
                    // Удалить расписание
                    Schedule::whereIn('id', $scheduleIds)->delete();
                }

                // Удалить записи о курсах, в которых учился пользователь
                Record::whereIn('course_id', $courseIds)->delete();

                // Удалить курсы
                Course::whereIn('id', $courseIds)->delete();
            }

            // Удалить все записи о посещаемости пользователя
            Attendance::where('student_id', $id)->delete();

            // Найти задания, в которых есть ответы пользователя
            $taskIds = Answer::where('student_id', $id)->pluck('task_id');

            if ($taskIds->isNotEmpty()) {
                // Удалить ответы пользователя
                Answer::where('student_id', $id)->delete();

                // Найти задания, на которые остались ответы других пользователей
                $remainingTaskIds = Answer::whereIn('task_id', $taskIds)->pluck('task_id');

                // Найти задания, которые можно удалить
                $tasksToDelete = $taskIds->diff($remainingTaskIds);

                if ($tasksToDelete->isNotEmpty()) {
                    Task::whereIn('id', $tasksToDelete)->delete();
                }
            }

            // Удалить все записи о курсах, в которых учился пользователь
            Record::where('student_id', $id)->delete();

            // Удалить пользователя
            $user->delete();
        });

        return redirect()->route('all-users-page')->with('success', 'Пользователь и все связанные данные удалены');
    }



}
