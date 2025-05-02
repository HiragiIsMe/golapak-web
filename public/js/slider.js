document.addEventListener('DOMContentLoaded', function() {
    const track = document.querySelector('.carousel-track');
    let slides = Array.from(track.children);
    const nextButton = document.querySelector('.carousel-btn.next');
    const prevButton = document.querySelector('.carousel-btn.prev');
    const slideWidth = slides[0].getBoundingClientRect().width;

    let currentIndex = 0;

    // Kloning manual semua untuk bikin loop
    slides.forEach(slide => {
        const clone = slide.cloneNode(true);
        track.appendChild(clone);
    });

    slides = Array.from(track.children); // Update slides array setelah clone

    const totalSlides = slides.length;

    // Setup awal posisi
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
        
                const middleIndex = currentIndex + 1; // TENGAH, bukan kiri
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

    // Auto-slide
    setInterval(nextSlide, 3000);
});
