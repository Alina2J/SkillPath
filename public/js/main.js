const sliderContainer = document.querySelector('.slider-container');
const slides = document.querySelectorAll('.slaider-item');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');
let currentIndex = 0;

function updateSlider() {
    const totalSlides = slides.length;
    // Сдвиг слайдов
    const offset = -currentIndex * 100; // 100% ширины одного слайда
    sliderContainer.style.transform = `translateX(${offset}%)`;
}

nextButton.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % slides.length; // Переход к следующему слайду
    updateSlider();
});

prevButton.addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length; // Переход к предыдущему слайду
    updateSlider();
});

// Автоматическая прокрутка (опционально)
setInterval(() => {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlider();
}, 3000); // Смена слайда каждые 3 секунды
