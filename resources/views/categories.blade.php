@extends('layout')

@section('title', 'Курс')

@section('page-content')
    <div class="container">
        <section class="categories">
            <div class="categories-header">
                <ul class="hashtags-list">
                    <li class="hashtag-item highlight"><a style="color: #fff"
                            href="{{ route('categories-page') }}">#ВсеКатегории</a></li>
                    @foreach ($global_categories as $category)
                        <li class="hashtag-item"><a style="color: #fff"
                                href="{{ route('category-middle-page', $category->id) }}">#{{ $category->title }}</a></li>
                    @endforeach
                </ul>
                <div class="section-header text-end">
                    <h2 class="section-title">Все категории</h2>
                    <p class="section-subtitle">самые познательные</p>
                </div>
            </div>
            <ul class="cards-list categories-list">
                @foreach ($categories as $category)
                    <li class="card-item">
                        <a href="{{ route('category-page', $category->id) }}" class="card-link">
                            <img width="156" height="156" src="/storage/{{ $category->photo_url }}" alt=""
                                class="card-img">
                            <div class="card-desc">
                                <h3 class="card-title">{{ $category->title }}</h3>
                                <p class="card-subtitle">{{ $category->globalCategory->title }}</p>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
@endsection
