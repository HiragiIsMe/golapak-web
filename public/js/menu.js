function initMenuPage() {
    const menuGrid = document.getElementById('menuGrid');
    const buttons = document.querySelectorAll('.menu-btn');

    if (!menuGrid || buttons.length === 0) return;

    let menuData = {};

    function fetchMenuData() {
        fetch('/get-menu')
            .then(response => response.json())
            .then(data => {
                menuData = data;
                renderMenu('makanan'); // default tampilkan kategori makanan
            })
            .catch(error => {
                console.error('Gagal mengambil data menu:', error);
                menuGrid.innerHTML = '<p style="text-align:center; color:red;">Gagal memuat data menu.</p>';
            });
    }

    function renderMenu(category) {
        if (!menuData[category]) {
            menuGrid.innerHTML = `<p style="text-align:center;">Tidak ada menu untuk kategori <b>${category}</b>.</p>`;
            return;
        }

        menuGrid.classList.add('slide-out');
        setTimeout(() => {
            menuGrid.innerHTML = '';
            menuData[category].forEach(item => {
                menuGrid.innerHTML += `
                    <div class="menu-card">
                        <img src="${item.img}" alt="${item.name}" class="menu-img">
                        <h3 class="menu-name">${item.name}</h3>
                        <p class="menu-desc">${item.desc}</p>
                    </div>
                `;
            });
            menuGrid.classList.remove('slide-out');
            menuGrid.classList.add('slide-in');
            setTimeout(() => {
                menuGrid.classList.remove('slide-in');
            }, 500);
        }, 500);
    }

    buttons.forEach(btn => {
        btn.addEventListener('click', function () {
            buttons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const category = this.getAttribute('data-category');
            renderMenu(category);
        });
    });

    // Mulai fetch data dari server
    fetchMenuData();
}

document.addEventListener('DOMContentLoaded', function () {
    if (typeof initSlider === 'function') initSlider();
    initMenuPage();
});
