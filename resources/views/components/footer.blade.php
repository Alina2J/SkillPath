<footer class="footer">
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
                </ul>
            </nav>
        </div>
        <p class="copyright">Copyright &copy; 2025 - SkillPath</p>
    </div>
</footer>



<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="/slick/slick.min.js"></script>

<script type="text/javascript">
    $('.slider-container').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true,
        autoplay: true,
        autoplaySpeed: 3000,
    });

    $('.slider-container-card').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });
</script>
