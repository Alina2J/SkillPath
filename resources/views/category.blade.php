@extends('layout')

@section('title', 'Курс')

@section('page-content')
    <div class="container">
        <section class="categories">
            <div class="categories-header">
                <ul class="hashtags-list">
                    <li class="hashtag-item highlight"><a style="color: #fff" href="{{ route('courses-page') }}">#ВсеКурсы</a>
                    </li>
                    <li class="hashtag-item highlight"><a style="color: #fff"
                            href="{{ route('categories-page') }}">#ВсеКатегории</a></li>
                    <li class="hashtag-item"><a style="color: #fff"
                            href="{{ route('category-middle-page', $category->globalCategory->id) }}">#{{ $category->globalCategory->title }}</a>
                    </li>
                    <li class="hashtag-item">#{{ $category->title }}</li>
                </ul>
                <div class="section-header text-end">
                    <h2 class="section-title">Все курсы</h2>
                    <p class="section-subtitle">самые лучшие</p>
                </div>
            </div>
            <ul style="display: grid; grid-template-columns: repeat(3, 1fr);" class="cards-list categories-list">
                @if ($courses->count() == 0)
                    <p style="font-size: 30px; font-weight: 700;" class="text-center">Курсов нет</p>
                @endif
                @foreach ($courses as $course)
                    <x-course :course="$course"></x-course>
                @endforeach
            </ul>
        </section>
    </div>
@endsection
