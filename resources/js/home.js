// Photo modal for profile show page
document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('photoModal');
  const modalImg = document.getElementById('photoModalImg');
  if (!modal || !modalImg) return;

  const openModal = (src) => {
    modalImg.src = src;
    modal.classList.remove('hidden');
  };

  const closeModal = () => {
    modal.classList.add('hidden');
    modalImg.src = '';
  };

  document.querySelectorAll('.photo-trigger').forEach((btn) => {
    btn.addEventListener('click', () => openModal(btn.dataset.full));
  });

  modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
  });
});
// Slider functionality
let currentSlide = 0;
const totalSlides = 5;
const sliderContainer = document.getElementById('sliderContainer');
const dots = document.querySelectorAll('.dot');

function updateSlider() {
    sliderContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentSlide);
    });
}

function changeSlide(direction) {
    currentSlide += direction;
    if (currentSlide < 0) currentSlide = totalSlides - 1;
    if (currentSlide >= totalSlides) currentSlide = 0;
    updateSlider();
}

function goToSlide(slideIndex) {
    currentSlide = slideIndex;
    updateSlider();
}

// Auto slide
setInterval(() => {
    changeSlide(1);
}, 5000);

// Touch/Swipe support
let touchStartX = 0;
let touchEndX = 0;

sliderContainer.addEventListener('touchstart', (e) => {
    touchStartX = e.changedTouches[0].screenX;
});

sliderContainer.addEventListener('touchend', (e) => {
    touchEndX = e.changedTouches[0].screenX;
    handleSwipe();
});

function handleSwipe() {
    if (touchEndX < touchStartX - 50) changeSlide(1);
    if (touchEndX > touchStartX + 50) changeSlide(-1);
}

// Mobile menu
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenu.classList.toggle('active');
}

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
            // Close mobile menu if open
            document.getElementById('mobileMenu').classList.remove('active');
        }
    });
});

// Parallax effect on scroll
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const shapes = document.querySelectorAll('.floating-shape');
    shapes.forEach((shape, index) => {
        const speed = 0.5 + index * 0.1;
        shape.style.transform = `translateY(${scrolled * speed}px)`;
    });
});

// Add glow effect on mouse move (desktop only)
if (window.innerWidth > 768) {
    document.addEventListener('mousemove', (e) => {
        const cards = document.querySelectorAll('.card-hover');
        cards.forEach(card => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            if (x >= 0 && x <= rect.width && y >= 0 && y <= rect.height) {
                card.style.background = `
                    radial-gradient(
                        600px circle at ${x}px ${y}px,
                        rgba(147, 51, 234, 0.1),
                        transparent 40%
                    ),
                    rgba(255, 255, 255, 0.05)
                `;
            }
        });
    });
}
