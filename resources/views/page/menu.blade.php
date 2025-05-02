@extends('layouts.main')

@section('title', 'Menu Kami')

@section('content')
<section class="menu-page">
    <h1 class="menu-title">Menu Kami</h1>

    <div class="menu-categories">
        <button class="menu-btn active" data-category="makanan">Makanan</button>
        <button class="menu-btn" data-category="minuman">Minuman</button>
        <button class="menu-btn" data-category="camilan">Camilan</button>
        <button class="menu-btn" data-category="tambahan">Tambahan</button>
    </div>

        <!-- Grid Container -->
    <div class="menu-grid" id="menuGrid">
        <!-- Card akan diisi lewat JavaScript -->
    </div>

    </div>
</section>
@endsection
