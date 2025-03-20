@extends('layout')

@section('title', 'Добавление расписания')

@section('page-content')
    <div class="container">
        <section class="login" style="margin-top: 20px; margin-bottom: 20px">
            <form action="{{ route('add-schedule', $id) }}" method="POST" class="login-form" enctype="multipart/form-data">
                @csrf
                <h2 class="login-title">Добавление расписания</h2>
                <div class="input-wrapper">
                    <label for="date">Дата</label>
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
