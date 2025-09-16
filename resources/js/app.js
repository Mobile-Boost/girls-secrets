import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/**************** WELCOME PAGE ****************/

    // Slider functionality
    document.addEventListener('DOMContentLoaded', function() {
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slider-item');
        const dots = document.querySelectorAll('.slider-dot');
        const sliderContainer = document.getElementById('sliderContainer');

        function showSlide(index) {
            if (index >= slides.length) index = 0;
            if (index < 0) index = slides.length - 1;

            sliderContainer.style.transform = `translateX(-${index * 100}%)`;
            currentSlide = index;

            // Update dots
            dots.forEach((dot, i) => {
                dot.classList.toggle('active-dot', i === index);
                dot.classList.toggle('bg-gray-600', i !== index);
                dot.classList.toggle('bg-purple-500', i === index);
            });
        }

        // Initialize dots
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => showSlide(i));
        });

        // Auto slide
        setInterval(() => {
            showSlide(currentSlide + 1);
        }, 5000);

        // Parallax effect on scroll
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.parallax');

            parallaxElements.forEach(element => {
                const speed = 0.5;
                element.style.backgroundPositionY = -(scrolled * speed) + 'px';
            });
        });
    });