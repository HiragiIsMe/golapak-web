function initSlider() {
    const track = document.querySelector('.carousel-track');
    if (!track) return; // Jika tidak ada slider, jangan lanjut

    let slides = Array.from(track.children);
    const nextButton = document.querySelector('.carousel-btn.next');
    const prevButton = document.querySelector('.carousel-btn.prev');

    if (!slides.length || !nextButton || !prevButton) return;

    const slideWidth = slides[0].getBoundingClientRect().width;
    let currentIndex = 0;

    // Hapus duplikat sebelumnya jika ada
    const originalSlidesCount = slides.length / 2;
    if (originalSlidesCount % 1 === 0) {
        while (track.children.length > originalSlidesCount) {
            track.removeChild(track.lastChild);
        }
    }

    // Kloning ulang untuk loop
    slides.forEach(slide => {
        const clone = slide.cloneNode(true);
        track.appendChild(clone);
    });

    slides = Array.from(track.children);
    const totalSlides = slides.length;

    const moveToSlide = (index) => {
        track.style.transition = 'transform 0.5s ease';
        track.style.transform = `translateX(-${slideWidth * index}px)`;

        slides.forEach(slide => slide.classList.remove('current-slide'));

        const middleVisible = Math.floor((window.innerWidth / slideWidth) / 2);
        const highlightIndex = index + middleVisible;

        if (slides[highlightIndex]) {
            slides[highlightIndex].classList.add('current-slide');
        }
    };

    const nextSlide = () => {
        currentIndex++;
        moveToSlide(currentIndex);

        if (currentIndex >= totalSlides / 2) {
            setTimeout(() => {
                track.style.transition = 'none';
                currentIndex = 0;
                track.style.transform = `translateX(0px)`;
                slides.forEach(slide => slide.classList.remove('current-slide'));
                const middleIndex = currentIndex + 1;
                if (slides[middleIndex]) {
                    slides[middleIndex].classList.add('current-slide');
                }
            }, 500);
        }
    };

    const prevSlide = () => {
        if (currentIndex <= 0) {
            currentIndex = totalSlides / 2;
            track.style.transition = 'none';
            track.style.transform = `translateX(-${slideWidth * currentIndex}px)`;
            setTimeout(() => {
                track.style.transition = 'transform 0.5s ease';
                currentIndex--;
                moveToSlide(currentIndex);
            }, 50);
        } else {
            currentIndex--;
            moveToSlide(currentIndex);
        }
    };

    nextButton.addEventListener('click', nextSlide);
    prevButton.addEventListener('click', prevSlide);

    setInterval(nextSlide, 3000);

    document.addEventListener('DOMContentLoaded', function () {
        if (typeof initSlider === 'function') initSlider();
        if (typeof initMenuPage === 'function') initMenuPage();
    });
    
}
