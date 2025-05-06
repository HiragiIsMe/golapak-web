function setActiveNav() {
    const links = document.querySelectorAll('.nav-link');
    links.forEach(link => {
        if (link.href === location.href || link.getAttribute('href') === location.pathname) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}

function initPage() {
    if (typeof initSlider === 'function') initSlider();
    if (typeof initMenuPage === 'function') initMenuPage();
    setActiveNav();
}

document.addEventListener('DOMContentLoaded', () => {
    initPage();
    const links = document.querySelectorAll('.nav-link');

    function handleNavClick(e) {
        e.preventDefault();

        const url = this.getAttribute('href');

        // Ambil konten dari server
        fetch(url)
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.querySelector('#content');
                document.querySelector('#content').innerHTML = newContent.innerHTML;

                // Update URL
                history.pushState({}, '', url);

                // Reset active class
                links.forEach(l => l.classList.remove('active'));
                this.classList.add('active');

                // Re-inisialisasi fitur JS jika ada
                if (typeof initSlider === 'function') initSlider();

                // ⬇ Tambahan: panggil initMenuPage jika halaman mengandung menu
                if (newContent.querySelector('#menuGrid')) {
                    if (typeof initMenuPage === 'function') initMenuPage();
                }
            });
    }

    links.forEach(link => link.addEventListener('click', handleNavClick));

    // Tangani tombol back/forward browser
    window.addEventListener('popstate', () => {
        fetch(location.href)
            .then(res => res.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newContent = doc.querySelector('#content');
                document.querySelector('#content').innerHTML = newContent.innerHTML;

                // ⬇ Tambahan: panggil initMenuPage jika halaman mengandung menu
                if (newContent.querySelector('#menuGrid')) {
                    if (typeof initMenuPage === 'function') initMenuPage();
                }
                
                if (typeof initSlider === 'function') initSlider();


                // Reset active class berdasarkan URL
                links.forEach(link => {
                    if (link.href === location.href) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });
            });
    });
});
