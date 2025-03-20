@extends('layout')

@section('title', 'Регистрация')

@section('page-content')
    <div class="container">
        <section class="login reg">
            <form action="{{ route('reg') }}" class="login-form" method="post">
                @csrf
                <h2 class="login-title">Регистрация</h2>
                <div class="input-wrapper">
                    <label for="email">E-mail</label>
                    <input value="{{ old('email') }}" type="email" name="email" id="email"
                        placeholder="Введите e-mail" class="form-input @error('email') is-invalid @enderror">
                    @error('email')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="password">Пароль</label>
                    <input type="password" id="password" name="password" placeholder="Введите пароль"
                        class="form-input @error('password') is-invalid @enderror">
                    @error('password')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="surname">Фамилия</label>
                    <input value="{{ old('surname') }}" name="surname" type="text" id="surname"
                        placeholder="Введите фамилию" class="form-input @error('surname') is-invalid @enderror">
                    @error('surname')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="name">Имя</label>
                    <input value="{{ old('name') }}" name="name" type="text" id="name"
                        placeholder="Введите имя" class="form-input @error('name') is-invalid @enderror">
                    @error('surname')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="middlename">Отчество</label>
                    <input value="{{ old('patronymic') }}" name="patronymic" type="text" id="middlename"
                        placeholder="Введите отчество" class="form-input @error('patronymic') is-invalid @enderror">
                    @error('patronymic')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="role">Выберите роль</label>
                    <select name="role" type="text" id="role"
                        class="form-select @error('role') is-invalid @enderror">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="form-button">Зарегистрироваться</button>
            </form>
        </section>
    </div>
@endsection
