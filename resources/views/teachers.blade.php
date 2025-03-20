@extends('layout')

@section('title', 'Профиль преподавателя')

@section('page-content')
    <div class="container">
        <section class="teachers">
            <div class="section-header text-center margin-center">
                <h1 class="section-title">Наши преподаватели</h1>
                <p class="section-subtitle">самые лучшие</p>
            </div>
            <ul class="cards-list categories-list teachers-list">
                @foreach ($teachers as $teacher)
                    <x-teacher :teacher="$teacher"></x-teacher>
                @endforeach
            </ul>
        </section>
    </div>
@endsection
