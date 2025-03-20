@extends('layout')

@section('title', 'Посещаемость')

@section('page-content')
    <div class="container">
        <section class="profile">
            @if (Auth::user()->role_id == 3)
                @php
                    $totalStudents = count($records); // Всего студентов в курсе
                    $attendanceCount = \App\Models\Attendance::where('schedule_id', $sheduleId)
                        ->whereIn('student_id', $records->pluck('student_id'))
                        ->count(); // Количество записей в attendances

                    $allStudentsHaveAttendance = $totalStudents > 0 && $totalStudents == $attendanceCount;
                    $attendanceWithTask = \App\Models\Attendance::where('schedule_id', $sheduleId)
                        ->whereNotNull('task_id')
                        ->first();
                @endphp

                @if ($allStudentsHaveAttendance)
                    @if (!$attendanceWithTask)
                        <a style="color: white; padding: 1rem 3.5rem; border-radius: 2.5rem; border: 1px solid #fff; margin-bottom: 2rem; display: inline-block; text-align: end"
                            href="{{ route('task-add-page', $sheduleId) }}">Добавить задание</a>
                    @else
                        <a style="color: white; padding: 1rem 3.5rem; border-radius: 2.5rem; border: 1px solid #fff; margin-bottom: 2rem; display: inline-block; text-align: end"
                            href="{{ route('task-page', ['id' => $attendanceWithTask->task_id]) }}">Открыть задание</a>
                    @endif
                @else
                    <h2 style="margin-bottom: 1rem; color: #fff; font-weight:700;">Проставьте посещаемость, чтобы добавить
                        задание!</h2>
                @endif

                <div class="profile-courses">
                    <h2>Посещаемость</h2>
                    <ul class="profile-courses__list">
                        @foreach ($records as $item)
                            <li style="display: flex; justify-content: space-between; padding: 10px 0"
                                class="profile-courses__item">
                                <p style="color: #fff; align-self:center;">{{ $item->student->name }}
                                    {{ $item->student->surname }}</p>

                                @php
                                    $attendance = \App\Models\Attendance::where('schedule_id', $sheduleId)
                                        ->where('student_id', $item->student->id)
                                        ->first();

                                    $answer =
                                        $attendance && $attendance->task_id
                                            ? \App\Models\Answer::where('task_id', $attendance->task_id)
                                                ->where('student_id', $item->student->id)
                                                ->first()
                                            : null;
                                @endphp

                                <form
                                    action="{{ route('add-student', ['id' => $sheduleId, 'studentId' => $item->student->id]) }}"
                                    method="POST">
                                    @csrf
                                    <label style="color: #fff; font-size: 14px">Был/Небыл</label>
                                    <input type="checkbox" name="is_be" value="1"
                                        {{ isset($attendance) && $attendance->is_be ? 'checked' : '' }}>
                                    <button type="submit"
                                        style="background-color: #4A8AC8; color: #fff; padding: 0.5rem 1rem; border-radius: 5px;">
                                        Сохранить
                                    </button>
                                </form>

                                <p style="color: #fff; align-self:center; display: flex;align-items: center;">
                                    Прикрепленный ответ:
                                    @if ($answer)
                                        <a href="{{ asset('storage/' . $answer->file_url) }}" target="_blank"
                                            style="color: #4A8AC8;">Ответ</a>
                                    @else
                                        нет
                                    @endif
                                </p>

                                <p style="color: #fff; align-self:center;">
                                    Оценка:
                                    @if ($answer)
                                        @if ($answer->mark > 0)
                                            {{ $answer->mark }}
                                        @else
                                            <form action="{{ route('grade.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="answer_id" value="{{ $answer->id }}">
                                                <div class="input-wrapper">
                                                    <input class="form-input" type="number" name="mark" min="0"
                                                        max="100" required>
                                                </div>
                                                <button class="form-button" type="submit">Сохранить</button>
                                            </form>
                                        @endif
                                    @else
                                        нет
                                    @endif
                                </p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </section>
    </div>
@endsection
