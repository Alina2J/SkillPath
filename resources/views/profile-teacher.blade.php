@extends('layout')

@section('title', 'Профиль преподавателя')

@section('page-content')
    <div class="container">
        <section class="profile ">
            <div class="profile-wrapper">
                <div class="profile-info">
                    <div class="profile-info__img">
                        <img src="/storage/{{ $teacher->photo_url }}" alt="profile">
                    </div>
                    <div class="profile-info__name">
                        <h1>{{ $teacher->surname }} {{ $teacher->name }} {{ $teacher->patronymic }}</h1>
                        <p>{{ $teacher->email }}</p>
                        <p class="highlight">{{ $teacher->direction }}</p>
                    </div>
                </div>
                <div class="profile-courses">
                    <h2>Курсы</h2>
                    <ul class="profile-courses__list">
                        @foreach ($courses as $course)
                            <li class="profile-courses__item">
                                <a href="{{ route('course-page', $course->id) }}">{{ $course->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="profile-desc">
                    <h2>Образование</h2>
                    <p>{{ $teacher->education }}</p>
                    <h2>О себе</h2>
                    <p>{{ $teacher->description }}</p>
                </div>
            </div>
        </section>
    </div>
@endsection
