@extends('layout')

@section('title', 'Главная')

@section('page-content')
    <div class="container">
        <section class="hero">
            <div class="hero-wrapper">
                <div class="half">
                    <div class="section-header">
                        <h1 class="section-title">Часто выбирают</h1>
                        <p class="section-subtitle">следующие направления</p>
                    </div>
                </div>
                <ul class="cards-list half">
                    @foreach ($sub_categories as $category)
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
            </div>
        </section>
        <section class="categories">
            <div class="categories-header">
                <ul class="hashtags-list">
                    <li class="hashtag-item highlight">#Обучение</li>
                    @foreach ($global_categories as $category)
                        <li class="hashtag-item"><a style="color: #fff"
                                href="{{ route('category-middle-page', $category->id) }}">#{{ $category->title }}</a></li>
                    @endforeach
                </ul>
                <div class="section-header text-end">
                    <h2 class="section-title">Категории курсов</h2>
                    <p class="section-subtitle">самые популярные</p>
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
            <div class="section-footer">
                <a class="section-link" href="{{ route('categories-page') }}">Все категории</a>
            </div>
        </section>
        <section class="about-us" id="about-us">
            <div class="section-header text-center margin-center">
                <h1 class="section-title">О нас</h1>
                <p class="section-subtitle">самое важное</p>
            </div>
            <div class="about-us-content">
                <h4 class="about-us-title">Добро пожаловать на #SkillPath</h4>
                <p class="about-us-subtitle">– вашего партнера <br>в персонализированном обучении!</p>
                <ul class="about-us-list">
                    <li class="about-us-item">
                        <p>В SkillPath мы верим, что образование должно адаптироваться к уникальным потребностям
                            каждого ученика</p>
                    </li>
                    <li class="about-us-item">
                        <p>Наша платформа сочетает передовой анализ данных и глубокое понимание современных
                            образовательных процессов, чтобы создать по-настоящему персонализированный учебный опыт
                        </p>
                    </li>
                </ul>
            </div>
        </section>
        <section class="reviews" id="rewiews">
            <div class="categories-header">
                <ul class="hashtags-list">
                    <li class="hashtag-item">#СдалНа90+</li>
                    <li class="hashtag-item highlight">#Обучение</li>
                    <li class="hashtag-item">#ПодготовкаОГЭ</li>
                    <li class="hashtag-item">#ЛучшиеПреподаватели</li>
                    <li class="hashtag-item">#Математика</li>
                    <li class="hashtag-item">#Репетиторство</li>
                    <li class="hashtag-item">#РусскийЯзык</li>
                </ul>
                <div class="section-header text-end">
                    <h2 class="section-title">Отзывы о нас</h2>
                    <p class="section-subtitle">самое приятное</p>
                </div>
            </div>
            <div class="slider">
                <div class="slider-container">
                    <div class="slider-item">
                        <img src="./images/reviews/massage.svg" alt="">
                        <div class="comment-content">
                            <div class="comment-header">
                                <img class="comment-author-img" src="./images/reviews/user-3.jpg" alt="">
                                <div class="comment-info">
                                    <h3 class="comment-name">Алексей Колков</h3>
                                    <p class="comment-subject">Английский язык</p>
                                </div>
                            </div>
                            <p class="comment-text">SkillPath помог мне выстроить идеальный учебный график!
                                Благодаря
                                персонализированным рекомендациям я смог пройти курс по подготовке к ЕГЭ быстрее,
                                чем
                                ожидал. Статистика прогресса вдохновляет учиться дальше!</p>
                            <p class="comment-date">18.01.2025</p>
                        </div>
                    </div>
                    <div class="slider-item">
                        <img src="./images/reviews/massage.svg" alt="">
                        <div class="comment-content">
                            <div class="comment-header">
                                <img class="comment-author-img" src="./images/reviews/user-1.jpg" alt="">
                                <div class="comment-info">
                                    <h3 class="comment-name">Иван Иванов</h3>
                                    <p class="comment-subject">Математика ЕГЭ</p>
                                </div>
                            </div>
                            <p class="comment-text">SkillPath помог мне выстроить идеальный учебный график!
                                Благодаря
                                персонализированным рекомендациям я смог пройти курс по подготовке к ЕГЭ быстрее,
                                чем
                                ожидал. Статистика прогресса вдохновляет учиться дальше!</p>
                            <p class="comment-date">25.01.2025</p>
                        </div>
                    </div>

                    <div class="slider-item">
                        <img src="./images/reviews/massage.svg" alt="">
                        <div class="comment-content">
                            <div class="comment-header">
                                <img class="comment-author-img" src="./images/reviews/user-2.jpg" alt="">
                                <div class="comment-info">
                                    <h3 class="comment-name">Наталия Петрова</h3>
                                    <p class="comment-subject">Обществознание ЕГЭ</p>
                                </div>
                            </div>
                            <p class="comment-text">SkillPath помог мне выстроить идеальный учебный график!
                                Благодаря
                                персонализированным рекомендациям я смог пройти курс по подготовке к ЕГЭ быстрее,
                                чем
                                ожидал. Статистика прогресса вдохновляет учиться дальше!</p>
                            <p class="comment-date">20.01.2025</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="message-team">
                <img src="./images/reviews/massage-2.png" alt="">
                <div class="message-team-content">
                    <h5>Большое Вам спасибо за приятные <br> отзывы!</h5>
                    <p class="text-end">Команда SkillPath</p>
                </div>
            </div>
        </section>
        <section class="teachers" id="teachers">
            <div class="section-header text-center margin-center">
                <h1 class="section-title">Наши преподаватели</h1>
                <p class="section-subtitle">самые лучшие</p>
            </div>
            <div class="slider-card">
                <ul class="slider-container-card cards-list categories-list">
                    @foreach ($teachers as $teacher)
                        <x-teacher :teacher="$teacher"></x-teacher>
                    @endforeach
                </ul>
            </div>
            <div class="section-footer">
                <a class="section-link" href="{{ route('teachers-page') }}">Все преподаватели</a>
            </div>
        </section>
    </div>
@endsection
