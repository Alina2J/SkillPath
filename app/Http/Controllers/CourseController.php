<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GlobalCategory;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Record;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Task;
use App\Models\Answer;

class CourseController extends Controller
{
    public function add_global_category(Request $request) {
        // Валидация данных
        $request->validate([
            'title' => 'required|string|unique:global_categories',
            'image' => 'required|mimes:jpeg,png',
        ]);

        // Создаем новую категорию
        $category = new GlobalCategory();
        $category->title = $request->input('title'); // Используем $request->input() для получения данных

        // Обработка загруженного файла
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $category->photo_url = $path; // Сохраняем путь к файлу в базу данных
        }

        // Сохраняем категорию в базу данных
        $category->save();

        // Перенаправляем пользователя
        return redirect()->route('profile-page');
    }

    public function add_sub_category(Request $request) {
        // Валидация данных
        $request->validate([
            'title' => 'required|string|unique:global_categories',
            'image' => 'required|mimes:jpeg,png',
            'category' => 'required',
        ]);

        // Создаем новую категорию
        $category = new SubCategory();
        $category->title = $request->input('title'); // Используем $request->input() для получения данных
        $category->global_category_id = $request->input('category'); // Используем $request->input() для получения данных
        // Обработка загруженного файла
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $category->photo_url = $path; // Сохраняем путь к файлу в базу данных
        }

        // Сохраняем категорию в базу данных
        $category->save();

        // Перенаправляем пользователя
        return redirect()->route('profile-page');
    }

    public function delete_global_category($id) {
        // Находим глобальную категорию
        $category = GlobalCategory::find($id);

        // Удаляем все курсы, связанные с подкатегориями этой глобальной категории
        $subcategories = SubCategory::where('global_category_id', $id)->get();
        foreach ($subcategories as $subcategory) {
            // Удаляем курсы, связанные с текущей подкатегорией
            Course::where('sub_category_id', $subcategory->id)->delete();
            // Удаляем саму подкатегорию
            $subcategory->delete();
        }

        // Удаляем глобальную категорию
        $category->delete();

        return redirect()->route('profile-page');
    }

    public function delete_sub_category($id) {
        $course = Course::where('sub_category_id', $id)->get();
        foreach ($course as $item) {
            $item->delete();
        }
        $category = SubCategory::find($id);
        $category->delete();
        return redirect()->route('profile-page');
    }

    public function add_schedule(Request $request, $id) {
        $shedule = new Schedule();
        $shedule->course_id = $id;
        $shedule->event_datetime = $request->input('date');
        $shedule->save();
        return redirect()->route('schedules-page', $id);
    }

    public function delete_schedule($id) {
        Attendance::where('schedule_id', $id)->delete();
        $schedule = Schedule::find($id);
        $courseId = $schedule->course_id;
        $schedule->delete();
        return redirect()->route('schedules-page', $courseId);
    }

    public function add_course(Request $request) {
        // Валидация данных
        $request->validate([
            'title' => 'required|string|unique:global_categories',
            'duration' => 'required|string',
            'count_lessons' => 'required',
            'description' => 'required|string',
            'price' => 'required|string',
            'count_students' => 'required|numeric',
            'image' => 'required|mimes:jpeg,png',
            'category' => 'required',
        ]);

        // Создаем новую категорию
        $course = new Course();
        $course->title = $request->input('title'); // Используем $request->input() для получения данных
        $course->duration = $request->input('duration');
        $course->count_lessons = $request->input('count_lessons');
        $course->description = $request->input('description');
        $course->price = $request->input('price');
        $course->count_students = $request->input('count_students');
        $course->sub_category_id = $request->input('category');
        $course->teacher_id = auth()->user()->id;
        // Обработка загруженного файла
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $course->photo_url = $path; // Сохраняем путь к файлу в базу данных
        }

        $course->save();

        return redirect()->route('course-page', $course->id);
    }

    public function edit_course(Request $request, $id) {
        // Валидация данных
        $request->validate([
            'title' => 'required|string|unique:global_categories',
            'duration' => 'required|string',
            'count_lessons' => 'required',
            'description' => 'required|string',
            'price' => 'required|string',
            'count_students' => 'required|numeric',
            'image' => 'mimes:jpeg,png',
            'category' => 'required',
        ]);

        // Создаем новую категорию
        $course = Course::find($id);
        $course->title = $request->input('title'); // Используем $request->input() для получения данных
        $course->duration = $request->input('duration');
        $course->count_lessons = $request->input('count_lessons');
        $course->description = $request->input('description');
        $course->price = $request->input('price');
        $course->count_students = $request->input('count_students');
        $course->sub_category_id = $request->input('category');
        $course->teacher_id = auth()->user()->id;
        // Обработка загруженного файла
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $course->photo_url = $path; // Сохраняем путь к файлу в базу данных
        }

        $course->save();

        return redirect()->route('course-page', $course->id);
    }

    public function delete_course($id) {
        // Находим глобальную категорию
        $course = Course::find($id);
        // Удаляем глобальную категорию
        $course->delete();

        return redirect()->route('profile-page');
    }

    public function add_student(Request $request, $scheduleId, $studentId) {
        // Проверяем, существует ли запись посещаемости
        $attendance = Attendance::where('schedule_id', $scheduleId)
            ->where('student_id', $studentId)
            ->first();

        Attendance::updateOrCreate(
            [
                'schedule_id' => $scheduleId,
                'student_id' => $studentId,
            ],
            [
                'is_be' => $request->has('is_be'), // Устанавливаем значение is_be в зависимости от чекбокса
                'task_id' => $attendance && $attendance->task_id ? $attendance->task_id : null, // Сохраняем task_id, если оно уже есть
            ]
        );

        $schedule = Schedule::find($scheduleId);
        $courseId = $schedule->course_id ?? null;

        return redirect()->route('attendance-page', [$courseId, $scheduleId]);
    }


    public function add_task(Request $request, $sheduleId) {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048'
        ]);

        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->start_date = now();
        $task->end_date = $request->input('date');
        // Обработка загруженного файла
        if ($request->hasFile('file')) { // Проверяем именно 'file'
            $path = $request->file('file')->store('uploads', 'public');
            $task->file_url = $path; // Сохраняем путь к файлу в базу данных
        }

        $task->save();

        $shedules = Attendance::where('schedule_id', $sheduleId)->get();
        foreach($shedules as $shedule) {
            $shedule->task_id = $task->id;
            $shedule->save();
        }

        return redirect()->route('task-page', $task->id);
    }

    public function buyCourse(Request $request, $courseId) {
        $user = Auth::user();

        // Проверяем, не купил ли уже этот пользователь курс
        $existingRecord = Record::where('course_id', $courseId)
            ->where('student_id', $user->id)
            ->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'Вы уже приобрели этот курс.');
        }

        // Добавляем запись о покупке
        Record::create([
            'course_id' => $courseId,
            'student_id' => $user->id,
            'price' => $request->price, // Цена со скидкой, если студент новый
        ]);

        return redirect()->back()->with('success', 'Курс успешно приобретен!');
    }


    public function store(Request $request) {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'description' => 'required|string',
            'file' => 'required|file|max:2048',
        ]);

        $filePath = $request->file('file')->store('answers', 'public');

        Answer::create([
            'task_id' => $request->task_id,
            'student_id' => Auth::id(),
            'description' => $request->description,
            'file_url' => $filePath,
            'date' => now(),
        ]);

        return redirect()->back()->with('success', 'Ответ успешно отправлен!');
    }

    public function store_mark(Request $request)
    {
        $request->validate([
            'answer_id' => 'required|exists:answers,id',
            'mark' => 'required|integer|min:0|max:100',
        ]);

        $answer = Answer::findOrFail($request->answer_id);
        $answer->mark = $request->mark;
        $answer->save();

        return back()->with('success', 'Оценка сохранена.');
    }
}
