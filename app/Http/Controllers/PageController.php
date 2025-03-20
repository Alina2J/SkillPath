<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use App\Models\Schedule;
use App\Models\GlobalCategory;
use App\Models\Attendance;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Record;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Answer;


class PageController extends Controller
{
    public function index()
    {
        // Получаем глобальные категории с их подкатегориями (ограничиваем до 4)
        $sub_categories = SubCategory::limit(4)->get();
        $global_categories = GlobalCategory::get();
        $categories = SubCategory::limit(8)->get();

        $teachers = User::where('role_id', 3)->get();

        return view('index', compact('sub_categories', 'categories', 'global_categories', 'teachers'));
    }

    public function categories() {

        $global_categories = GlobalCategory::get();
        $categories = SubCategory::all();

        return view('categories', compact('categories', 'global_categories'));
    }

    public function schedules($id) {
        $shedules = Schedule::where('course_id', $id)->get();
        return view('schedules', compact('shedules', 'id'));
    }

    public function attendance($id, $sheduleId) {
        // Получаем всех студентов, записанных на курс
        $records = Record::where('course_id', $id)->get();

        return view('attendances', compact('records', 'sheduleId'));
    }

    public function add_task($sheduleId) {
        return view('add-task', compact('sheduleId'));
    }

    public function schedule_add($id) {
        return view('schedule-add', compact('id'));
    }

    public function category($id) {
        $category = SubCategory::find($id);
        $courses = Course::where('sub_category_id', $id)->get();
        return view('category', compact('courses', 'category'));
    }

    public function category_middle($id) {
        $globalCategory = GlobalCategory::findOrFail($id);

        $subCategories = SubCategory::where('global_category_id', $id)->get();

        $subCategoryIds = $subCategories->pluck('id');

        $courses = Course::whereIn('sub_category_id', $subCategoryIds)->get();

        return view('category-middle', compact('courses', 'globalCategory'));
    }

    public function courses() {
        $courses = Course::all();
        $global_categories = GlobalCategory::all();
        return view('courses', compact('courses', 'global_categories'));
    }

    public function course($id) {
        $course = Course::findOrFail($id);
        $user = auth()->user();

        $isTeacher = $user && $user->role_id == 3 && $user->id == $course->teacher_id;
        $isPurchased = $user && \App\Models\Record::where('course_id', $id)
            ->where('student_id', $user->id)
            ->exists();

        return view('course', compact('course', 'isPurchased', 'isTeacher'));
    }

    public function task($id) {
        $task = Task::findOrFail($id);
        $user = Auth::user();

        // Проверка срока сдачи
        $now = Carbon::now();
        $isWithinDeadline = $now->between($task->start_date, $task->end_date);

        // Получаем ответ пользователя (если он есть)
        $answer = Answer::where('task_id', $task->id)
            ->where('student_id', $user->id)
            ->first();

        // Проверяем, есть ли у пользователя ответ
        $hasAnswered = $answer !== null;

        // Получаем оценку (если ответа нет, ставим 0)
        $grade = $answer ? $answer->mark : null;

        // Получаем курс через связи таблиц
        $course = Course::whereHas('schedules', function ($query) use ($id) {
            $query->whereHas('attendances', function ($subQuery) use ($id) {
                $subQuery->where('task_id', $id);
            });
        })->first();

        // Проверяем, купил ли пользователь этот курс
        $hasPurchased = Record::where('student_id', $user->id)
            ->where('course_id', $course->id ?? null)
            ->exists();

        return view('task', compact('task', 'isWithinDeadline', 'hasAnswered', 'hasPurchased', 'grade'));
    }


    public function login() {
        return view('login');
    }

    public function sign_up() {
        $roles = Role::where('id', '!=', 1)->get();
        return view('sign-up', compact('roles'));
    }

    public function forgot_pass() {
        return view('forgot-pass');
    }

    public function teachers() {

        $teachers = User::where('role_id', 3)->get();

        return view('teachers', compact('teachers'));
    }

    public function teacher($id) {
        $teacher = User::find($id);
        $courses = Course::where('teacher_id', $id)->get();
        return view('profile-teacher', compact('teacher', 'courses'));
    }

    public function profile() {
        $sub_categories = SubCategory::get();
        $global_categories = GlobalCategory::get();
        $user = Auth::user();
        if ($user->role_id == 3) { // Предположим, что 2 — это учитель
            $courses = Course::where('teacher_id', $user->id)->get();
        } else { // Для студентов
            $courses = Course::whereIn('id', Record::where('student_id', $user->id)->pluck('course_id'))->get();
        }
        return view('profile', compact('sub_categories', 'global_categories', 'courses'));
    }

    public function edit_course($id) {
        $course = Course::find($id);
        $categories = SubCategory::with('globalCategory')->get();
        return view('edit-course', compact('course', 'categories'));
    }

    public function reset(Request $request) {
        return view('reset-password', ['request' => $request]);
    }

    public function edit() {
        return view('edit-profile');
    }

    public function all_users() {
        $users = User::all();
        return view('all-users', compact('users'));
    }

    public function add_global_category() {
        return view('add-global-category');
    }

    public function profile_user($id) {
        $user = User::find($id);
        return view('profile-user', compact('user'));
    }

    public function add_sub_category() {
        $categories = GlobalCategory::all();
        return view('add-sub-category', compact('categories'));
    }

    public function add_course() {
        $categories = SubCategory::with('globalCategory')->get();
        return view('add-course', compact('categories'));
    }
}
