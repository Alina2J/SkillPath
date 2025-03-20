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
                    @foreach ($global_categories as $category)
                        <li class="hashtag-item"><a style="color: #fff"
                                href="{{ route('category-middle-page', $category->id) }}">#{{ $category->title }}</a></li>
                    @endforeach
                </ul>
                <div class="section-header text-end">
                    <h2 class="section-title">Все курсы</h2>
                    <p class="section-subtitle">самые лучшие</p>
                </div>
            </div>
            <ul style="display: grid; grid-template-columns: repeat(3, 1fr);" class="cards-list categories-list">
                @foreach ($courses as $course)
                    <x-course :course="$course"></x-course>
                @endforeach
            </ul>
        </section>
    </div>
@endsection
