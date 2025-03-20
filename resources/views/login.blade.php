@extends('layout')

@section('title', 'Авторизация')

@section('page-content')
    <div class="container">
        <section class="login">
            <form action="{{ route('auth') }}" method="POST" class="login-form">
                @csrf
                <h2 class="login-title">Авторизация</h2>
                @if (session('status'))
                    <p
                        style="border-radius: 10px; font-weight: bold; background-color: #fa9848; color: white; text-align:center; padding: 10px;">
                        Пароль был успешно изменён!</p>
                @endif
                <div class="input-wrapper">
                    <label for="email">E-mail</label>
                    <input value="{{ old('email') }}" name="email" type="email" id="email"
                        placeholder="Введите e-mail" class="form-input @error('email') is-invalid @enderror">
                    @error('email')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="password">Пароль</label>
                    <input type="password" name="password" id="password" placeholder="Введите пароль"
                        class="form-input @error('password') is-invalid @enderror">
                    @error('password')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="form-button">Войти</button>
                <div class="form-footer">
                    <a href="{{ route('forgot-pass-page') }}" class="login-link">Забыли пароль?</a>
                    <a href="{{ route('sign-up-page') }}" class="login-link">Регистрация</a>
                </div>

            </form>
        </section>
    </div>
@endsection
