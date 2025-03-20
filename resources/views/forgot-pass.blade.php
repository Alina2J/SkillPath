@extends('layout')

@section('title', 'Забыли пароль?')

@section('page-content')
    <div class="container">
        <section class="login">
            <form action="{{ route('password') }}" method="POST" class="login-form">
                @csrf
                <h2 class="login-title">Забыли пароль?</h2>
                @if (session('status'))
                    <p
                        style="border-radius: 10px; font-weight: bold; background-color: #fa9848; color: white; text-align:center; padding: 10px;">
                        Письмо для сброса пароля отправлено
                        на указанную почту!</p>
                @endif
                <p>Введите e-mail, указанный при регистрации</p>
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
                <button type="submit" class="form-button">Отправить</button>
            </form>
        </section>
    </div>
@endsection
