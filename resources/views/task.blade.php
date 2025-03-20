@extends('layout')

@section('title', 'Задание')

@section('page-content')
    <div class="container">
        <section class="profile">
            <div class="course-wrapper">
                <div class="profile-info">
                    <div class="profile-info__name">
                        <h1>{{ $task->title }}</h1>
                        <p>Сроки для сдачи</p>
                        <p class="highlight">{{ $task->start_date }} - {{ $task->end_date }}</p>
                    </div>
                </div>

                <div style="grid-column: 1 / 2; grid-row: 2 / 4;" class="profile-desc">
                    <h2>Описание</h2>
                    <p>{{ $task->description }}</p>

                    @if ($task->file_url)
                        <h2>Прикрепленные файлы</h2>

                        @php
                            $extension = pathinfo($task->file_url, PATHINFO_EXTENSION);
                            $iconPath = asset('images/icons/default.png');

                            $icons = [
                                'pdf' => asset('images/icons/pdf.png'),
                                'doc' => asset('images/icons/doc.png'),
                                'docx' => asset('images/icons/doc.png'),
                                'jpg' => asset('images/icons/image.png'),
                                'jpeg' => asset('images/icons/image.png'),
                                'png' => asset('images/icons/image.png'),
                            ];

                            if (isset($icons[$extension])) {
                                $iconPath = $icons[$extension];
                            }
                        @endphp

                        <p>
                            <a href="{{ asset('storage/' . $task->file_url) }}" target="_blank" download
                                style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: #fff;">
                                <img src="{{ $iconPath }}" alt="{{ $extension }}" width="30" height="30">
                                Скачать
                            </a>
                        </p>
                    @else
                        <p>Файлы не прикреплены.</p>
                    @endif
                </div>

                @if ($hasAnswered)
                    <div style="grid-row: 1 / 4;" class="profile-desc">
                        <h2>Вы уже сдали задание</h2>
                        <p>Ваша оценка:</p>
                        @if ($grade === 0)
                            <p><strong>Оценка еще не была выставлена</strong></p>
                        @else
                            <p><strong>{{ $grade }}</strong></p>
                        @endif
                    </div>
                @elseif ($isWithinDeadline && $hasPurchased)
                    <div style="grid-row: 1 / 4;" class="profile-desc">
                        <h2>Прикрепить ответ</h2>
                        <form style="display: flex; flex-direction:column;" action="{{ route('answer.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input class="form-input" type="hidden" name="task_id" value="{{ $task->id }}">

                            <div class="input-wrapper">
                                <label for="description">Описание ответа:</label>
                                <textarea class="form-input" name="description" id="description" rows="4" required></textarea>
                            </div>

                            <div class="input-wrapper">
                                <label for="file">Файл:</label>
                                <input class="form-input" type="file" name="file" id="file" required>
                            </div>

                            <button style="margin-top: 1rem" class="form-button" type="submit">Отправить</button>
                        </form>
                    </div>
                @endif

            </div>
        </section>
    </div>
@endsection
