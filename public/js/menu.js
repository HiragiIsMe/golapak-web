
document.addEventListener('DOMContentLoaded', function() {
    const menuGrid = document.getElementById('menuGrid');
    const buttons = document.querySelectorAll('.menu-btn');

    // Simulasi data menu
    const menuData = {
        makanan: [
            { img: 'img/menu/makanan/Mie-ayam.jpg', name: 'Mie Ayam', desc: 'Mie ayam enak dan lezat.' },
            { img: 'img/menu/makanan/bakso.jpg', name: 'Bakso Jumbo', desc: 'Bakso super besar.' },
            { img: 'img/menu/makanan/nasi-bakar.jpg', name: 'Nasi Bakar', desc: 'Nasi bakar wangi daun pisang.' },
            { img: 'img/menu/makanan/nasi-kuning.jpg', name: 'Nasi Kuning', desc: 'Nasi kuning spesial.' },
            { img: 'img/menu/makanan/nasi-lemak.jpg', name: 'Nasi Lemak', desc: 'Nasi lemak khas Malaysia.' },
            { img: 'img/menu/makanan/nasi-telur.jpg', name: 'Nasi Telur', desc: 'Nasi telur sederhana.' }
        ],
        minuman: [
            { img: 'img/menu/minuman/es-teh-manis.jpg', name: 'Es Teh Manis', desc: 'Teh manis dingin.' },
            { img: 'img/menu/minuman/es-jeruk.jpg', name: 'Es Jeruk', desc: 'Segar dan manis.' },
            { img: 'img/menu/minuman/kopi-hitam.jpg', name: 'Kopi Hitam', desc: 'Kopi hitam panas.' },
            { img: 'img/menu/minuman/matcha-latte.jpg', name: 'Matcha Latte', desc: 'Matcha segar.' },
            { img: 'img/menu/minuman/milo-dingin.jpg', name: 'Milo Dingin', desc: 'Milo cokelat dingin.' },
            { img: 'img/menu/minuman/lemon-tea.jpg', name: 'Lemon Tea', desc: 'Teh lemon seger.' }
        ],
        camilan: [
            { img: 'img/menu/camilan/risol-mayo.jpg', name: 'Risol Mayo', desc: 'Risol isi mayo.' },
            { img: 'img/menu/camilan/pisang-coklat.jpg', name: 'Pisang Coklat', desc: 'Pisang dibalut coklat.' },
            { img: 'img/menu/camilan/sosis-gulung.jpg', name: 'Sosis Gulung', desc: 'Sosis dengan kulit krispi.' },
            { img: 'img/menu/camilan/keripik-singkong.jpg', name: 'Keripik Singkong', desc: 'Keripik garing.' },
            { img: 'img/menu/camilan/martabak-mini.jpg', name: 'Martabak Mini', desc: 'Martabak aneka rasa.' },
            { img: 'img/menu/camilan/donat.jpg', name: 'Donat', desc: 'Donat empuk manis.' }
        ],
        tambahan: [
            { img: 'img/menu/tambahan/sambal.jpg', name: 'Sambal', desc: 'Sambal pedas spesial.' },
            { img: 'img/menu/tambahan/kerupuk.jpg', name: 'Kerupuk', desc: 'Kerupuk renyah.' },
            { img: 'img/menu/tambahan/acar.jpg', name: 'Acar', desc: 'Acar segar.' },
            { img: 'img/menu/tambahan/saus-tomat.jpg', name: 'Saus Tomat', desc: 'Saus tomat manis.' },
            { img: 'img/menu/tambahan/saus-pedas.jpg', name: 'Saus Pedas', desc: 'Saus pedas nendang.' },
            { img: 'img/menu/tambahan/mayonaise.jpg', name: 'Mayonaise', desc: 'Mayonaise creamy.' }
        ]
    };

    // Function render menu
    function renderMenu(category) {
        menuGrid.classList.add('slide-out'); // keluar ke kiri

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
            menuGrid.classList.add('slide-in'); // masuk dari kanan

            setTimeout(() => {
                menuGrid.classList.remove('slide-in');
            }, 500);
        }, 500);
    }

    // Event click kategori
    buttons.forEach(btn => {
        btn.addEventListener('click', function() {
            buttons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const category = this.getAttribute('data-category');
            renderMenu(category);
        });
    });

    // Load awal
    renderMenu('makanan');
});

