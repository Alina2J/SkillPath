<header class="header">
    <div class="container">
        <div class="header-wrapper">
            <a href="{{ route('main-page') }}" class="header-logo">Skill<span>Path</span></a>
            <nav class="header-nav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="{{ route('main-page') }}" class="nav-link">Главная</a></li>
                    <li class="nav-item"><a href="{{ route('courses-page') }}" class="nav-link">Курсы</a></li>
                    <li class="nav-item"><a href="{{ route('main-page') }}#about-us" class="nav-link">О нас</a></li>
                    <li class="nav-item"><a href="{{ route('main-page') }}#rewiews" class="nav-link">Отзывы</a></li>
                    <li class="nav-item"><a href="{{ route('main-page') }}#teachers" class="nav-link">Преподаватели</a>
                    </li>
                    @if (Auth::user())
                        <li class="nav-item"><a href="{{ route('profile-page') }}" class="nav-link bg-link">Профиль</a>
                        </li>
                    @else
                        <li class="nav-item"><a href="{{ route('login-page') }}" class="nav-link bg-link">Войти</a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</header>
