@extends('layout')

@section('title', 'Все пользователи')

@section('page-content')
    <div class="container">
        <section class="profile">
            @if (Auth::user()->role_id == 1)
                <div class="profile-courses">
                    <h2>Все пользователи</h2>
                    <ul class="profile-courses__list">
                        @foreach ($users as $user)
                            <li style="display: flex; justify-content: space-between" class="profile-courses__item">
                                <a href="{{ route('profile-user-page', $user->id) }}">{{ $user->surname }}
                                    {{ $user->name }} {{ $user->patronymic }}</a>
                                <form action="{{ route('delete-user', $user->id) }}" method="POST">
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
            @endif
        </section>
    </div>
@endsection
