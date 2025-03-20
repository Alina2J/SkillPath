@extends('layout')

@section('title', 'Профиль')

@section('page-content')
    <div class="container">
        <section class="profile ">
            <div class="profile-wrapper">
                <div class="profile-info">
                    <div class="profile-info__img">
                        <img src="/storage/{{ Auth::user()->photo_url }}" alt="profile">
                    </div>
                    <div class="profile-info__name">
                        <h1>{{ Auth::user()->surname }} {{ Auth::user()->name }} {{ Auth::user()->patronymic }}</h1>
                        <p>{{ Auth::user()->email }}</p>
                        @if (Auth::user()->role_id == 3)
                            <p class="highlight">{{ Auth::user()->direction }}</p>
                        @else
                            <p class="highlight">{{ Auth::user()->role->role }}</p>
                        @endif

                    </div>
                </div>
                @if (Auth::user()->role_id == 1)
                    <div class="profile-courses">
                        <h2>Администрирование</h2>
                        <ul class="profile-courses__list">
                            <li class="profile-courses__item">
                                <a href="{{ route('add-global-category-page') }}">Создать глобальную категорию</a>
                            </li>
                            <li class="profile-courses__item">
                                <a href="{{ route('add-sub-category-page') }}">Создать подглобальную категорию</a>
                            </li>
                            <li class="profile-courses__item">
                                <a href="{{ route('all-users-page') }}">Все пользователи</a>
                            </li>
                        </ul>
                    </div>
                    <div class="profile-desc" style="text-align: end;">
                        <a href="{{ route('logout') }}"
                            style="background-color: #fa9848; color: #fff; padding: 1rem 3.5rem; border-radius: 2.5rem">Выход</a>
                    </div>
                    <div class="profile-desc">
                        <h2>Глобальные категории</h2>
                        <ul class="cards-list categories-list">
                            @foreach ($global_categories as $category)
                                <li class="card-item admin">
                                    <a href="#!" class="card-link">
                                        <img width="156" height="156" src="/storage/{{ $category->photo_url }}"
                                            alt="" class="card-img">
                                        <div class="card-desc">
                                            <h3 class="card-title">{{ $category->title }}</h3>
                                        </div>
                                    </a>
                                    <form action="{{ route('delete-global-category', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            style="background-color: #fa9848; color: #fff; padding: 1rem 1.5rem; border-radius: 2.5rem"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                            </svg></button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="profile-desc">
                        <h2>Подглобальные категории</h2>
                        <ul class="cards-list categories-list">
                            @foreach ($sub_categories as $category)
                                <li class="card-item admin">
                                    <a href="#!" class="card-link">
                                        <img width="156" height="156" src="/storage/{{ $category->photo_url }}"
                                            alt="" class="card-img">
                                        <div class="card-desc">
                                            <h3 class="card-title">{{ $category->title }}</h3>
                                            <p style="color: #003364;" class="card-subtitle">
                                                {{ $category->globalCategory->title }}</p>
                                        </div>
                                    </a>
                                    <form cl action="{{ route('delete-sub-category', $category->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            style="background-color: #fa9848; color: #fff; padding: 1rem 1.5rem; border-radius: 2.5rem"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                            </svg></button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="profile-courses">
                        <h2>Mои курсы</h2>
                        <ul class="profile-courses__list">
                            @if ($courses->count() === 0)
                                <li class="profile-courses__item"><a href="#!">Нет курсов</a></li>
                            @else
                                @foreach ($courses as $course)
                                    <li class="profile-courses__item">
                                        <a href="{{ route('course-page', $course->id) }}">{{ $course->title }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="profile-desc">
                        <h2>Описание</h2>
                        <p>{{ Auth::user()->description }}</p>
                        @if (Auth::user()->role_id == 3)
                            <h2>Образование</h2>
                            <p>{{ Auth::user()->education }}</p>
                        @endif
                    </div>
                    <div class="profile-desc" style="text-align: end;">
                        @if (Auth::user()->role_id == 3)
                            <a href="{{ route('add-course-page') }}"
                                style="background-color: #fa9848; color: #fff; padding: 1rem 3.5rem; border-radius: 2.5rem">Создать
                                курс</a>
                        @endif
                        @if (Auth::user()->role_id !== 1)
                            <a href="{{ route('edit-profile') }}"
                                style="background-color: #fa9848; color: #fff; padding: 1rem 3.5rem; border-radius: 2.5rem">Редактировать
                                профиль</a>
                        @endif


                        <a href="{{ route('logout') }}"
                            style="background-color: #fa9848; color: #fff; padding: 1rem 3.5rem; border-radius: 2.5rem">Выход</a>
                    </div>
                @endif

            </div>
        </section>
    </div>
@endsection
