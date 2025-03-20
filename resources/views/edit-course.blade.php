@extends('layout')

@section('title', 'Редактирование курса')

@section('page-content')
    <div class="container">
        <section class="login" style="margin-top: 20px; margin-bottom: 20px">
            <form action="{{ route('edit-course', $course->id) }}" method="POST" class="login-form"
                enctype="multipart/form-data">
                @csrf
                <h2 class="login-title">Редактирование курса</h2>
                <div class="input-wrapper">
                    <label for="title">Название</label>
                    <input value="{{ old('title') ?: $course->title }}" name="title" type="text" id="title"
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
                        class="form-input @error('image') is-invalid @enderror">
                    @error('image')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="category">Категория</label>
                    <select name="category" id="category" class="form-input @error('category') is-invalid @enderror"
                        required>
                        @foreach ($categories->groupBy('globalCategory.title') as $globalCategory => $subCategories)
                            <optgroup style="color: black" label="{{ $subCategories->first()->globalCategory->title }}">
                                @foreach ($subCategories as $category)
                                    <option style="color: black;" value="{{ $category->id }}"
                                        {{ $category->id == $course->subCategory->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('category')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="duration">Длительность</label>
                    <input value="{{ old('duration') ?: $course->duration }}" placeholder="Введите длительность"
                        type="text" name="duration" id="duration"
                        class="form-input @error('duration') is-invalid @enderror" required>
                    @error('duration')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="count_lessons">Количество уроков в неделю</label>
                    <input value="{{ old('count_lessons') ?: $course->count_lessons }}"
                        placeholder="Введите количество уроков" type="text" name="count_lessons" id="count_lessons"
                        class="form-input @error('count_lessons') is-invalid @enderror" required>
                    @error('count_lessons')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="description">Описание</label>
                    <textarea placeholder="Введите описание" style="resize: none" class="form-input @error('image') is-invalid @enderror"
                        name="description" id="description" cols="30" rows="10">{{ old('description') ?: $course->description }}</textarea>
                    @error('description')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="price">Цена</label>
                    <input value="{{ old('price') ?: $course->price }}" placeholder="Введите цену" type="text"
                        name="price" id="price" class="form-input @error('price') is-invalid @enderror" required>
                    @error('price')
                        <div style="width: 350px" class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-wrapper">
                    <label for="count_students">Количество студентов на курс</label>
                    <input value="{{ old('count_students') ?: $course->count_students }}" placeholder="Введите количество"
                        type="text" name="count_students" id="count_students"
                        class="form-input @error('count_students') is-invalid @enderror" required>
                    @error('count_students')
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
