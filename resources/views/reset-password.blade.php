@extends('layout')

@section('title', 'Сброс пароля')

@section('page-content')
    <div class="container">
        <section class="login">
            <form novalidate action="{{ route('password.update') }}" method="POST" class="login-form">
                @csrf
                <h2 class="login-title">Сброс пароля'</h2>
                <div class="input-wrapper">
                    <input type="hidden" name="token" value="{{ $request->token }}">
                    <label for="email">E-mail</label>
                    <input value="{{ old('email', $request->email) }}" name="email" type="email" id="email"
                        placeholder="Введите e-mail" readonly class="form-input @error('email') is-invalid @enderror">
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
                <div class="input-wrapper">
                    <label for="password_confirmation">Пароль</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Введите пароль" class="form-input @error('password') is-invalid @enderror">
                    @error('password')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="form-button">Сбросить</button>
            </form>
        </section>
    </div>
@endsection
