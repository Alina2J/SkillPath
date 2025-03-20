@extends('layout')

@section('title', 'Редактирование профиля')

@section('page-content')
    <div class="container">
        <section style="margin-top: 20px; margin-bottom: 20px" class="login reg">
            <form action="{{ route('edit') }}" class="login-form" method="post" enctype="multipart/form-data">
                @csrf
                <h2 class="login-title">Редактирование профиля</h2>
                <div class="input-wrapper">
                    <label for="surname">Фамилия</label>
                    <input value="{{ old('surname') ?: Auth::user()->surname }}" name="surname" type="text"
                        id="surname" placeholder="Введите фамилию"
                        class="form-input @error('surname') is-invalid @enderror">
                    @error('surname')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="name">Имя</label>
                    <input value="{{ old('name') ?: Auth::user()->name }}" name="name" type="text" id="name"
                        placeholder="Введите имя" class="form-input @error('name') is-invalid @enderror">
                    @error('surname')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="middlename">Отчество</label>
                    <input value="{{ old('patronymic') ?: Auth::user()->patronymic }}" name="patronymic" type="text"
                        id="middlename" placeholder="Введите отчество"
                        class="form-input @error('patronymic') is-invalid @enderror">
                    @error('patronymic')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="image">Картинка</label>
                    <input name="image" type="file" id="image"
                        class="form-input @error('image') is-invalid @enderror">
                    @error('image')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @if (Auth::user()->role_id == 2)
                    <div class="input-wrapper">
                        <label for="description">Описание</label>
                        <textarea style="resize: none" class="form-input @error('image') is-invalid @enderror" name="description"
                            id="description" cols="30" rows="10">{{ old('description') ?: Auth::user()->description }}</textarea>
                        @error('description')
                            <div style="width: 350px" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @elseif (Auth::user()->role_id == 3)
                    <div class="input-wrapper">
                        <label for="description">Описание</label>
                        <textarea style="resize: none" class="form-input @error('image') is-invalid @enderror" name="description"
                            id="description" cols="30" rows="10">{{ old('description') ?: Auth::user()->description }}</textarea>
                        @error('description')
                            <div style="width: 350px" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-wrapper">
                        <label for="education">Образование</label>
                        <textarea placeholder="Введите ваше образование макимально подробно" style="resize: none"
                            class="form-input @error('image') is-invalid @enderror" name="education" id="education" cols="30"
                            rows="10">{{ old('education') ?: Auth::user()->education }}</textarea>
                        @error('education')
                            <div style="width: 350px" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-wrapper">
                        <label for="direction">Направления</label>
                        <input placeholder="Введите направления вашего образования"
                            value="{{ old('direction') ?: Auth::user()->direction }}"
                            class="form-input @error('direction') is-invalid @enderror" name="direction" id="direction"
                            type="text">
                        @error('direction')
                            <div style="width: 350px" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif

                <button type="submit" class="form-button">Редактировать</button>
            </form>
        </section>
    </div>
@endsection
