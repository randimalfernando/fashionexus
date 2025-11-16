// JavaScript to control the slider transition
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;
const slider = document.getElementById('slider');

function showNextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    slider.style.transform = `translateX(-${currentSlide * 100}%)`;
}

setInterval(showNextSlide, 5000); // Change slide every 5 seconds
