@extends('layout')

@section('title', 'Добавление задания')

@section('page-content')
    <div class="container">
        <section class="login" style="margin-top: 20px; margin-bottom: 20px">
            <form action="{{ route('add-task', $sheduleId) }}" method="POST" class="login-form" enctype="multipart/form-data">
                @csrf
                <h2 class="login-title">Добавление задания</h2>
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
                    <label for="description">Описание</label>
                    <textarea placeholder="Введите описание" style="resize: none" class="form-input @error('image') is-invalid @enderror"
                        name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                    @error('description')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="file">Файл</label>
                    <input type="file" name="file" id="file"
                        class="form-input @error('file') is-invalid @enderror">
                    @error('file')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="date">Дата оканчания сдачи задания</label>
                    <input value="{{ old('date') }}" name="date" type="datetime-local" id="date"
                        placeholder="Введите название" class="form-input @error('date') is-invalid @enderror" required>
                    @error('date')
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
