@extends('layouts.dashboard-admin')

@section('title', 'Dashboard Home')

@section('content')

<div class="container mt-4">
    <!-- Row Informasi -->
    <div class="row mb-4">
        <div class="col-md-6 d-flex">
            <div class="box-info w-100 h-100">
                JUMLAH PESANAN <br> HARI INI
                <div class="box-number">000</div>
            </div>
        </div>
        <div class="col-md-6 d-flex">
            <div class="box-info w-100 h-100">
                <div id="tanggal">00/00/0000</div>
                <div id="waktu" class="box-number">00 : 00 : 00</div>
            </div>
        </div>
    </div>
    

    <!-- Konfirmasi Pembelian Online -->
    <h5 class="fw-bold mb-2">Status Pembelian (Online)</h5>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Nama Pembeli</th>
                    <th>Status Pembelian</th>
                    <th>Jenis Pesanann</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>XB9380180283</td>
                    <td>Budi</td>
                    <td class="status-konfirmasi">Menunggu Konfirmasi</td>
                    <td>Take Away</td>
                    <td><button class="icon-button online-btn"><i class="fa-solid fa-tarp"></i></button></td>
                </tr>
                <tr>
                    <td>XB9380180283</td>
                    <td>Budi</td>
                    <td class="status-proses">Sedang Diantar</td>
                    <td>Delivery</td>
                    <td><button class="icon-button online-btn"><i class="fa-solid fa-tarp"></i></button></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal Detail Pesanan -->
<div class="modal fade" id="modalDetailPesanan" tabindex="-1" aria-labelledby="modalLabelPesanan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-orange p-4" style="border-radius: 20px; background-color: #efefef;">
        <div class="modal-header border-0">
          <h5 class="modal-title w-100 text-center fw-bold">Detail Pesanan (Offline)</h5>
          <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
  
          <!-- Jenis Pesanan -->
          <div class="order-type-toggle mx-auto mb-4">
            <div class="toggle-wrapper">
                <div id="toggleIndicator" class="toggle-indicator"></div>
                <button class="toggle-btn" id="btnDineIn">Dine In</button>
                <button class="toggle-btn" id="btnTakeAway">Take Away</button>
            </div>
        </div>
  
          <!-- Informasi Transaksi -->
          <div class="mb-3">
            <strong>Kode Transaksi:</strong> XB9380180283 <br>
            <strong>Nama Pembeli:</strong> <input type="text" class="form-control mt-1" value="Budi">
          </div>
  
          <!-- Tabel Pesanan -->
          <div class="table-responsive mb-4">
            <table class="table text-center">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Qty</th>
                  <th>Harga</th>
                </tr>
              </thead>
              <tbody>
                <tr><td>Nasi Goreng</td><td>1</td><td>10.000</td></tr>
                <tr><td>Nasi Goreng</td><td>1</td><td>10.000</td></tr>
                <tr><td>Nasi Goreng</td><td>1</td><td>10.000</td></tr>
              </tbody>
            </table>
          </div>
  
          <hr>
  
          <!-- Ringkasan Harga -->
          <div class="text-end">
            <div>Sub Total: <strong>120.000</strong></div>
            <div>Pajak: <strong>10.000</strong></div>
            <div class="fs-5 fw-bold mt-2">TOTAL: <span class="text-dark">140.000</span></div>
          </div>
  
          <!-- Tombol Aksi -->
          <div class="mt-4 d-flex justify-content-between">
            <button class="btn btn-secondary">Kembali</button>
            <button class="btn btn-danger">Batalkan Pesanan</button>
            <button class="btn btn-warning text-white">Cetak Struk</button>
          </div>
  
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Konfirmasi Pembelian -->
<div class="modal fade" id="modalKonfirmasiPembelian" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-orange p-4" style="border-radius: 20px; background-color: #efefef;">
        <div class="modal-header border-0">
          <h5 class="modal-title w-100 text-center fw-bold">Konfirmasi Pembelian</h5>
          <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
  
          <!-- Informasi Transaksi -->
          <div class="mb-3">
            <div><strong>Status Transaksi:</strong> <span class="text-danger fw-bold">Menunggu Konfirmasi</span></div>
            <div><strong>Kode Transaksi:</strong> XB9380180283</div>
            <div><strong>Jenis Pesanan:</strong> Delivery</div>
            <div><strong>Nama Pembeli:</strong> Budi</div>
          </div>
  
          <!-- Tabel Pesanan -->
          <div class="table-responsive mb-3">
            <table class="table text-center">
              <thead>
                <tr><th>Nama</th><th>Qty</th><th>Harga</th></tr>
              </thead>
              <tbody>
                <tr><td>Nasi Goreng</td><td>1</td><td>10.000</td></tr>
                <tr><td>Nasi Goreng</td><td>1</td><td>10.000</td></tr>
                <tr><td>Nasi Goreng</td><td>1</td><td>10.000</td></tr>
                <tr><td>Ongkir</td><td>1</td><td>10.000</td></tr>
                <tr class="fw-bold text-danger"><td colspan="2">Sub Total</td><td>50.000</td></tr>
                <tr class="fw-bold text-danger"><td colspan="2">TOTAL</td><td>50.000</td></tr>
              </tbody>
            </table>
          </div>
  
          <!-- Alamat Pembeli -->
          <div class="mb-4">
            <strong>Alamat Pembeli :</strong>
            <div>Jalan Riau Nomor 21, Krajan Barat, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur</div>
          </div>
  
          <!-- Tombol Aksi -->
          <div class="d-flex justify-content-between">
            <button class="btn btn-danger">Batalkan Pembelian</button>
            <button class="btn btn-primary">Konfirmasi Pembelian</button>
          </div>
  
        </div>
      </div>
    </div>
  </div>
  
</div>

<!-- Script waktu -->
<script>
    function updateTime() {
        const now = new Date();
        const jam = String(now.getHours()).padStart(2, '0');
        const menit = String(now.getMinutes()).padStart(2, '0');
        const detik = String(now.getSeconds()).padStart(2, '0');
        const tanggal = String(now.getDate()).padStart(2, '0');
        const bulan = String(now.getMonth() + 1).padStart(2, '0');
        const tahun = now.getFullYear();

        document.getElementById("waktu").innerText = `${jam} : ${menit} : ${detik}`;
        document.getElementById("tanggal").innerText = `${tanggal}/${bulan}/${tahun}`;
    }

    setInterval(updateTime, 1000);


   

// Toggle Dine In / Take Away
document.getElementById("btnDineIn").addEventListener("click", function() {
  this.classList.add("btn-warning", "text-white");
  this.classList.remove("btn-outline-secondary");
  document.getElementById("btnTakeAway").classList.remove("btn-warning", "text-white");
  document.getElementById("btnTakeAway").classList.add("btn-outline-secondary");
});

document.getElementById("btnTakeAway").addEventListener("click", function() {
  this.classList.add("btn-warning", "text-white");
  this.classList.remove("btn-outline-secondary");
  document.getElementById("btnDineIn").classList.remove("btn-warning", "text-white");
  document.getElementById("btnDineIn").classList.add("btn-outline-secondary");
});

// Tombol pop out modal offline
document.querySelectorAll('.offline-btn').forEach(button => {
  button.addEventListener('click', () => {
    const modal = new bootstrap.Modal(document.getElementById('modalDetailPesanan'));
    modal.show();
  });
});

// Tombol pop out modal online
document.querySelectorAll('.online-btn').forEach(button => {
  button.addEventListener('click', () => {
    const modal = new bootstrap.Modal(document.getElementById('modalKonfirmasiPembelian'));
    modal.show();
  });

// btn dine in dan take away
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

});


</script>

<style>
    .box-info {
    background-color: #ffffff;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    color: #f15a24;
    font-weight: bold;
    font-size: 18px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    min-height: 130px; /* kamu bisa atur sesuai kebutuhan */
    }


    .box-number {
        font-size: 32px;
        margin-top: 10px;
        color: #000;
    }

    .status-belum {
        color: red;
        font-weight: bold;
    }

    .status-proses {
        color: orange;
        font-weight: bold;
    }

    .status-konfirmasi {
        color: orangered;
        font-weight: bold;
    }

    table th, table td {
        vertical-align: middle !important;
    }

    .icon-button {
        background-color: transparent;
        border: none;
        font-size: 18px;
        color: #000;
    }

    .table th {
        background-color: orange;
    }

    table, th, td {
    border: 2px solid #5f5e5e !important;
        
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

</style>
@endsection
