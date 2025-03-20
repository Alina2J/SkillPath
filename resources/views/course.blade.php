@extends('layout')

@section('title', 'Курс')

@section('page-content')
    <div class="container">
        <section class="profile">
            <div class="course-wrapper">
                <div style="display: grid; grid-template-columns: 1fr 2fr;" class="profile-info">
                    <img src="/storage/{{ $course->photo_url }}" alt="profile">
                    <div class="profile-info__name">
                        <h1>{{ $course->title }}</h1>
                        <p>{{ $course->subCategory->title }}</p>
                        <p class="highlight">{{ $course->duration }} - {{ $course->count_lessons }}
                            {{ trans_choice('раз|раза|раз', $course->count_lessons) }} в неделю</p>
                    </div>
                </div>
                <div class="profile-info">
                    <h2>Курс ведет</h2>
                    <div class="profile-info-wrapper">
                        <div class="profile-info__img">
                            <img src="/storage/{{ $course->teacher->photo_url }}" alt="profile">
                        </div>
                        <div class="profile-info__name">
                            <a href="{{ route('teacher-page', $course->teacher_id) }}">
                                <h1>{{ $course->teacher->surname }} {{ $course->teacher->name }}
                                    {{ $course->teacher->patronymic }}</h1>
                            </a>
                            <p>{{ $course->teacher->email }}</p>
                            <p class="highlight">{{ $course->teacher->direction }}</p>
                        </div>
                    </div>
                    <div class="course-profile-desc">
                        <h2>Образование</h2>
                        <p>{{ $course->teacher->education }}</p>
                    </div>
                </div>
                <div class="profile-desc">
                    <h2>Описание</h2>
                    <p>{{ $course->description }}</p>
                </div>

                <div class="profile-courses">
                    @if ($isPurchased || $isTeacher)
                        @if ($isTeacher)
                        @else
                            <h2>Расписание занятий</h2>
                            @php
                                $schedules = \App\Models\Schedule::where('course_id', $course->id)->get();
                            @endphp

                            @if ($schedules->isEmpty())
                                <p style="color: white">Расписание еще не добавлено.</p>
                            @else
                                <table style="width: 100%; border-collapse: collapse; color: white;">
                                    <thead>
                                        <tr style="background-color: #4A8AC8">
                                            <th style="padding: 10px; border: 1px solid #ddd;">Дата</th>
                                            <th style="padding: 10px; border: 1px solid #ddd;">Задание</th>
                                            <th style="padding: 10px; border: 1px solid #ddd;">Оценка</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                            @php
                                                $attendance = \App\Models\Attendance::where(
                                                    'schedule_id',
                                                    $schedule->id,
                                                )
                                                    ->where('student_id', Auth::user()->id)
                                                    ->first();
                                            @endphp
                                            <tr>
                                                <td style="padding: 10px; border: 1px solid #ddd;">
                                                    {{ \Carbon\Carbon::parse($schedule->event_datetime)->format('d.m.Y') }}
                                                </td>
                                                <td style="padding: 10px; border: 1px solid #ddd;">
                                                    @if ($attendance && $attendance->task)
                                                        <a href="{{ route('task-page', $attendance->task->id) }}">
                                                            {{ $attendance->task->title }}
                                                        </a>
                                                    @else
                                                        Нет задания
                                                    @endif
                                                </td>
                                                <td style="padding: 10px; border: 1px solid #ddd;">
                                                    @if ($attendance && $attendance->task)
                                                        @php
                                                            $answer = \App\Models\Answer::where(
                                                                'task_id',
                                                                $attendance->task->id,
                                                            )
                                                                ->where('student_id', Auth::user()->id)
                                                                ->first();
                                                        @endphp

                                                        {{ $answer && $answer->mark !== null ? $answer->mark : 'Нет оценки' }}
                                                    @else
                                                        Нет оценки
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        @endif

                        @if ($isTeacher)
                            <ul style="display: flex; justify-content: end; gap: 1rem; margin-top: 5rem">
                                <li class="profile-courses__item">
                                    <a href="{{ route('schedules-page', $course->id) }}" class="btn">Расписание</a>
                                </li>
                                <li class="profile-courses__item">
                                    <a href="{{ route('edit-course-page', $course->id) }}" class="btn">Редактировать</a>
                                </li>
                                <li class="profile-courses__item">
                                    <form action="{{ route('delete-course', $course->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            style="background-color: #003364; padding: 1rem 2rem; border-radius: 2.5rem; width: fit-content;"
                                            class="btn btn-danger" type="submit">Удалить</button>
                                    </form>
                                </li>
                            </ul>
                        @endif
                    @else
                        @php
                            $hasStarted = \App\Models\Attendance::whereHas('schedule', function ($query) use ($course) {
                                $query->where('course_id', $course->id);
                            })
                                ->where('is_be', 1)
                                ->exists();
                        @endphp

                        @if ($hasStarted)
                            <h2 style="color: white;">Курс уже идет, запись закрыта</h2>
                        @else
                            <h2>Цена</h2>
                            <ul class="profile-courses__list">
                                @php
                                    if (Auth::check()) {
                                        $rating =
                                            \App\Models\NormalizeResult::where('user_id', Auth::user()->id)->value(
                                                'Result',
                                            ) ?? 0;

                                        if ($rating < 0.5) {
                                            $discount = 0.2;
                                        } elseif ($rating < 0.8) {
                                            $discount = 0.1;
                                        } else {
                                            $discount = 0.05;
                                        }
                                    } else {
                                        $discount = 0.2;
                                    }

                                    $discountedPrice = intval($course->price * (1 - $discount));
                                @endphp

                                <li class="profile-courses__item">
                                    Обычная цена: <b>{{ $course->price }}₽</b>
                                </li>
                                <li class="profile-courses__item">
                                    С учетом скидки: <b>{{ $discountedPrice }}₽</b>
                                </li>

                                @if (Auth::check())
                                    <li class="profile-courses__item">
                                        Ваша скидка: <b>{{ $discount * 100 }}%</b>
                                    </li>
                                    <li class="profile-courses__item">
                                        <form action="{{ route('buy-course', $course->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="price" value="{{ $discountedPrice }}">
                                            <button type="submit"
                                                style="background-color: #4A8AC8; color: #fff; padding: 1rem 2rem; border-radius: 2.5rem; border: none;">
                                                Купить
                                            </button>
                                        </form>
                                    </li>
                                @else
                                    <li class="profile-courses__item">
                                        <a href="{{ route('login-page') }}">Авторизуйтесь, чтобы купить</a>
                                    </li>
                                @endif
                            </ul>
                        @endif

                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection
