@extends('layouts.dashboard-admin')

@section('title', 'Dashboard Kasir')

@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex mb-3 align-items-center gap-2">
                <input type="text" id="menuSearch" class="form-control w-50" placeholder="Cari menu...">
                <button class="btn category-btn active" data-category="makanan">Makanan</button>
                <button class="btn category-btn" data-category="minuman">Minuman</button>
            </div>

            <div class="menu-slider-wrapper mb-3">
                <div class="menu-slider" id="menuSlider">
                    <!-- Makanan Panel -->
                    <div class="menu-panel">
                        <div class="row g-3">
                            @foreach ($makanan as $data)
                                <div class="col-md-4">
                                    <div class="card text-center shadow-sm">
                                        <img src="{{ asset('storage/' . $data['image']) }}" class="card-img-top" alt="menu" style="height:150px; object-fit: cover;">
                                        <div class="card-body p-2">
                                            <div class="fw-bold menu-name">{{ $data['name'] }}</div>
                                            <div class="text-muted menu-price">{{ $data['main_cost'] }}</div>
                                            <div class="menu-action mt-2">
                                                <button class="btn qty-button btn-warning add-to-cart" 
                                                    data-id="{{ $data['id'] }}"
                                                    data-name="{{ $data['name'] }}" 
                                                    data-price="{{ $data['main_cost'] }}">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Minuman Panel -->
                    <div class="menu-panel">
                        <div class="row g-3">
                            @foreach ($minuman as $data)
                                <div class="col-md-4">
                                    <div class="card text-center shadow-sm">
                                        <img src="{{ asset('storage/' . $data['image']) }}" class="card-img-top" alt="menu" style="height:150px; object-fit: cover;">
                                        <div class="card-body p-2">
                                            <div class="fw-bold menu-name">{{ $data['name'] }}</div>
                                            <div class="text-muted menu-price">{{ $data['main_cost'] }}</div>
                                            <div class="menu-action mt-2">
                                                <button class="btn qty-button btn-warning add-to-cart" 
                                                    data-id="{{ $data['id'] }}"
                                                    data-name="{{ $data['name'] }}" 
                                                    data-price="{{ $data['main_cost'] }}">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cart -->
        <div class="col-md-4">
            <div class="bg-white p-4 shadow-sm rounded">
                <h5 class="fw-bold text-center">Keranjang Pesanan</h5>
                <form id="checkout-form">
                    @csrf
                    <input type="hidden" name="order_type" id="order_type">
                    <div class="order-type-toggle mx-auto mb-4">
                        <div class="toggle-wrapper">
                            <div id="toggleIndicator" class="toggle-indicator"></div>
                            <button type="button" class="toggle-btn" id="btnDineIn" onclick="setOrderType('dine-in')">Dine In</button> 
                            <button type="button" class="toggle-btn" id="btnTakeAway" onclick="setOrderType('take-away')">Take Away</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <strong>Nama Pembeli:</strong>
                        <input type="text" class="form-control mt-1" placeholder="Nama Pembeli" name="pembeli" required>
                    </div>

                    <div class="table-responsive mb-3">
                        <table class="table table-bordered text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody id="cart-items">
                                <!-- Render dari JS -->
                            </tbody>
                        </table>
                    </div>

                    <div class="text-end mb-3">
                        <div class="fs-5 fw-bold mt-2">TOTAL: <span class="text-dark">0</span></div>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-warning text-white">Cetak Struk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Styles & Scripts -->
<style>
    .menu-action {
    display: flex;
    justify-content: center;
}

    .qty-button {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    padding: 0;
    font-weight: bold;
    font-size: 16px;
    line-height: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.2s;
}

.qty-button.btn-outline-success {
    border: 2px solid #198754; /* Bootstrap success */
    color: #198754;
    background-color: white;
}

.qty-button.btn-outline-success:hover {
    background-color: #198754;
    color: white;
}

.qty-display {
    min-width: 24px;
    text-align: center;
    font-weight: 500;
}

    .category-btn {
    background-color: #f8f9fa; /* abu-abu terang / bootstrap-light */
    color: #333;
    border: 1px solid #ff7f24;
    transition: 0.3s;
}

.category-btn.active {
    background-color: #ff7f24;
    color: white;
}

#menuSearch {
    max-width: 250px;
}

.order-type-toggle {
    width: 220px;
    position: relative;
}

.toggle-wrapper {
    position: relative;
    display: flex;
    border: 1px solid #ccc;
    border-radius: 25px;
    overflow: hidden;
    background-color: #fff;
}

.toggle-indicator {
    position: absolute;
    top: 0;
    left: 0;
    width: 50%;
    height: 100%;
    background-color: #ff7f24;
    border-radius: 25px;
    transition: 0.3s;
    z-index: 0;
}

.toggle-btn {
    flex: 1;
    padding: 8px 0;
    border: none;
    background: none;
    z-index: 1;
    font-weight: 600;
    color: #333;
    transition: 0.3s;
    cursor: pointer;
}

.toggle-btn.active {
    color: white;
}
.menu-slider-wrapper {
    overflow: hidden;
    width: 100%;
    position: relative;
}

.menu-slider {
    display: flex;
    transition: transform 0.5s ease;
    width: 200%;
}

.menu-panel {
    width: 100%;
    padding-right: 1rem;
    padding-left: 1rem;
}
.category-btn.active {
    background-color: #ff7f24 !important;
    color: white !important;
}


</style>

<script src="https://cdn.jsdelivr.net/npm/rsvp@4.8.5/dist/rsvp.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qz-tray@2.1.1/qz-tray.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jssha@3.2.0/src/sha256.js"></script>
<script>
    document.getElementById("btnDineIn").addEventListener("click", function () {
        this.classList.add("active");
        document.getElementById("btnTakeAway").classList.remove("active");
    });

    document.getElementById("btnTakeAway").addEventListener("click", function () {
        this.classList.add("active");
        document.getElementById("btnDineIn").classList.remove("active");
    });

    const btnDineIn = document.getElementById("btnDineIn");
    const btnTakeAway = document.getElementById("btnTakeAway");
    const toggleIndicator = document.getElementById("toggleIndicator");

    btnDineIn.addEventListener("click", () => {
        toggleIndicator.style.left = "0%";
        btnDineIn.classList.add("active");
        btnTakeAway.classList.remove("active");
    });

    btnTakeAway.addEventListener("click", () => {
        toggleIndicator.style.left = "50%";
        btnTakeAway.classList.add("active");
        btnDineIn.classList.remove("active");
    });

const categoryBtns = document.querySelectorAll(".category-btn");
    const slider = document.getElementById("menuSlider");

    categoryBtns.forEach(btn => {
        btn.addEventListener("click", function () {
            categoryBtns.forEach(b => b.classList.remove("active"));
            this.classList.add("active");

            const category = this.getAttribute("data-category");
            if (category === "makanan") {
                slider.style.transform = "translateX(0%)";
            } else {
                slider.style.transform = "translateX(-50%)";
            }
        });
    });

    let cart = {};

function renderCart() {
    const tbody = document.getElementById('cart-items');
    tbody.innerHTML = '';

    let subtotal = 0;

    Object.keys(cart).forEach(name => {
        const item = cart[name];
        const row = document.createElement('tr');
        row.innerHTML = `
        <td>${name}</td>
        <td>
            <div class="d-flex justify-content-center align-items-center gap-2">
                <button class="btn qty-button btn-outline-success btn-decrease" data-name="${name}">–</button>
                <span class="qty-display">${item.qty}</span>
                <button class="btn qty-button btn-outline-success btn-increase" data-name="${name}">+</button>
            </div>
        </td>
        <td>${(item.price * item.qty).toLocaleString()}</td>
    `;
        tbody.appendChild(row);
        subtotal += item.price * item.qty;
    });

    document.querySelector('.text-end').innerHTML = `
        <div class="fs-5 fw-bold mt-2">TOTAL: <span class="text-dark">${(subtotal).toLocaleString()}</span></div>
    `;
}


document.addEventListener('click', function(e) {
    if (e.target.classList.contains('add-to-cart')) {
        const name = e.target.dataset.name;
        const price = parseInt(e.target.dataset.price);
        const id = e.target.dataset.id;

        if (!cart[name]) {
            cart[name] = { id: id, price: price, qty: 1 };
        } else {
            cart[name].qty++;
        }

        renderCart();

        const cardBody = e.target.closest('.card-body');
        const actionArea = cardBody.querySelector('.menu-action');
        actionArea.innerHTML = `
    <div class="d-flex justify-content-center align-items-center gap-2">
        <button class="btn qty-button btn-outline-success btn-decrease" data-name="${name}">–</button>
        <span class="qty-display">${cart[name].qty}</span>
        <button class="btn qty-button btn-outline-success btn-increase" data-name="${name}">+</button>
    </div>
`;

    }

    if (e.target.classList.contains('btn-increase')) {
        const name = e.target.dataset.name;
        cart[name].qty++;
        renderCart();
        updateCardQtyDisplay();
    }

    if (e.target.classList.contains('btn-decrease')) {
    const name = e.target.dataset.name;

    if (cart[name].qty > 1) {
        cart[name].qty--;
    } else {
        delete cart[name];

        const cards = document.querySelectorAll('.card-body');
        cards.forEach(card => {
            const menuName = card.querySelector('.menu-name')?.textContent.trim();
            if (menuName === name) {
                const menuAction = card.querySelector('.menu-action');
                const price = card.querySelector('.menu-price')?.textContent.replace('.', '').trim();

               menuAction.innerHTML = `
                <button class="btn qty-button btn-warning add-to-cart" 
                        data-id="${cart[name]?.id || ''}" 
                        data-name="${name}" 
                        data-price="${price}">+</button>
            `;
            }
        });
    }

    renderCart();
    updateCardQtyDisplay();
}

function updateCardQtyDisplay() {
    const cards = document.querySelectorAll('.card-body');
    cards.forEach(card => {
        const name = card.querySelector('.menu-name')?.textContent.trim();
        if (name && cart[name]) {
            const qtyDisplay = card.querySelector('.menu-action span');
            if (qtyDisplay) {
                qtyDisplay.textContent = cart[name].qty;
            }
        }
    });
}

    
});

function setOrderType(type) {
        document.getElementById('order_type').value = type;
    }

// search bar js
    document.getElementById("menuSearch").addEventListener("input", function () {
    const keyword = this.value.toLowerCase();
    const allCards = document.querySelectorAll(".menu-panel.active .card");

    allCards.forEach(card => {
        const name = card.querySelector(".menu-name").textContent.toLowerCase();
        if (name.includes(keyword)) {
            card.parentElement.style.display = "block";
        } else {
            card.parentElement.style.display = "none";
        }
    });
});

function updateActivePanel() {
    document.querySelectorAll('.menu-panel').forEach(panel => panel.classList.remove('active'));
    const category = document.querySelector('.category-btn.active').getAttribute('data-category');
    const index = category === 'makanan' ? 0 : 1;
    document.querySelectorAll('.menu-panel')[index].classList.add('active');
}
categoryBtns.forEach(btn => {
    btn.addEventListener("click", function () {
        categoryBtns.forEach(b => b.classList.remove("active"));
        this.classList.add("active");

        const category = this.getAttribute("data-category");
        slider.style.transform = category === "makanan" ? "translateX(0%)" : "translateX(-50%)";

        updateActivePanel();
    });
});
document.getElementById('checkout-form').addEventListener('submit', async function (e) {
    e.preventDefault();
    const pembeli = this.pembeli.value.trim();
    const orderType = document.getElementById('order_type').value;
    const menuItems = Object.values(cart).map(item => ({ id: item.id, qty: item.qty }));

    if (!pembeli) {
        alert("Nama pembeli harus diisi");
        return;
    }

    if (menuItems.length === 0) {
        alert("Keranjang belanja kosong");
        return;
    }

    try {
        const response = await fetch('/api/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ 
                pembeli, 
                menu: menuItems,
                order_type: orderType
            })
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || 'Gagal melakukan checkout');
        }

        if (data.status === 'success') {
            try {
                await printStruk(data.transaction);
                cart = {};
                renderCart();
                updateCardQtyDisplay();
            } catch (printError) {
                console.log(printError);
            }
        } else {
            alert(data.message || "Gagal melakukan checkout");
        }
    } catch (error) {
        console.error("Checkout error:", error);
        alert(error.message || "Terjadi kesalahan saat checkout");
    }
});

async function printStruk(transaction) {
        try {
            // Pastikan QZ Tray terinstall dan terhubung
            if (!qz.websocket.isActive()) {
                await qz.websocket.connect();
            }

            // Dapatkan printer default
            const printer = await qz.printers.getDefault();

            // Format struk
            const config = qz.configs.create(printer, { 
                scaleContent: false,
                colorType: 'grayscale'
            });

            const ESC = '\x1B', GS = '\x1D';
            let lines = [
                `${ESC}@`,
                `${ESC}a1`, // Center align
                "STRUK PEMBELIAN\n\n",
                `${ESC}a0`, // Left align
                "Kode: " + transaction.transaction_code + "\n",
                "Tanggal: " + new Date(transaction.date).toLocaleString() + "\n",
                "-----------------------------\n",
                "Pembeli: " + transaction.nama_pelanggan_offline + "\n",
                "-----------------------------\n"
            ];

            // Tambahkan detail item
            transaction.details.forEach(detail => {
                lines.push(`${detail.menu.name}\n`);
                lines.push(`  ${detail.qty} x ${detail.main_cost.toLocaleString()} = ${detail.main_subtotal.toLocaleString()}\n`);
            });

            lines.push(
                "-----------------------------\n",
                `${ESC}a2`, // Right align
                "TOTAL: Rp" + transaction.grand_total.toLocaleString() + "\n\n",
                `${ESC}a1`, // Center align
                "Terima kasih telah berbelanja\n\n\n",
                `${GS}V\x41` // Cut paper
            );

            // Cetak
            await qz.print(config, lines);
            
        } catch (error) {
            alert("Gagal mencetak struk. Pastikan QZ Tray sudah terinstall dan berjalan.");
            // Fallback: tampilkan struk di popup jika print gagal
            const strukText = lines.join('').replace(/\n/g, '<br>');
            const win = window.open('', '_blank');
            win.document.write(`<pre>${strukText}</pre>`);
        }
    }


updateActivePanel();
</script>
@endsection
