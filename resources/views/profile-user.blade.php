@extends('layout')

@section('title', 'Профиль')

@section('page-content')
    <div class="container">
        <section class="profile ">
            <div class="profile-wrapper">
                <div class="profile-info">
                    <div class="profile-info__img">
                        <img src="/storage/{{ $user->photo_url }}" alt="profile">
                    </div>
                    <div class="profile-info__name">
                        <h1>{{ $user->surname }} {{ $user->name }} {{ $user->patronymic }}</h1>
                        <p>{{ $user->email }}</p>
                        <p class="highlight">{{ $user->role->role }}</p>
                    </div>
                </div>
                <div class="profile-courses">
                    <h2>Mои курсы</h2>
                    <ul class="profile-courses__list">
                        <li class="profile-courses__item">
                            <a href="course.html">Физика 10-11 класс</a>
                        </li>
                        <li class="profile-courses__item">
                            <a href="course.html">Математика 10-11 класс</a>
                        </li>
                        <li class="profile-courses__item">
                            <a href="course.html">Физика ОГЭ</a>
                        </li>
                    </ul>
                </div>
                <div class="profile-desc">
                    <h2>Описание</h2>
                    <p>{{ $user->description }}</p>
                </div>

            </div>
        </section>
    </div>
@endsection
