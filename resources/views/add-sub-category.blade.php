@extends('layout')

@section('title', 'Добавление категории')

@section('page-content')
    <div class="container">
        <section class="login">
            <form action="{{ route('add-sub-category') }}" method="POST" class="login-form" enctype="multipart/form-data">
                @csrf
                <h2 class="login-title">Добавление категории</h2>
                <div class="input-wrapper">
                    <label for="title">Название</label>
                    <input value="{{ old('title') }}" name="title" type="text" id="title"
                        placeholder="Введите название" class="form-input @error('title') is-invalid @enderror" required>
                    @error('title')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="image">Картинка</label>
                    <input type="file" name="image" id="image"
                        class="form-input @error('image') is-invalid @enderror" required>
                    @error('image')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="category">Глобальная категория</label>
                    <select name="category" id="category" class="form-input @error('category') is-invalid @enderror"
                        required>
                        @foreach ($categories as $category)
                            <option style="color: black;" value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="form-button">Создать</button>
            </form>
        </section>
    </div>
@endsection
