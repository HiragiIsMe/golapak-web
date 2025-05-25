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
      <div class="mb-3">
       <input type="text" id="search-konfirmasi" class="form-control w-25" placeholder="🔍 Cari Transaksi Online...">
      </div>

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

  // Tombol pop out modal online
  document.querySelectorAll('.online-btn').forEach(button => {
    button.addEventListener('click', () => {
      const modal = new bootstrap.Modal(document.getElementById('modalKonfirmasiPembelian'));
      modal.show();
    });

  });

  document.getElementById('search-konfirmasi').addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('table tbody tr');

        rows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(keyword) ? '' : 'none';
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
    min-height: 130px; 
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
