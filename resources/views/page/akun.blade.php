@extends('layouts.login')

@section('title', 'Login Admin')

@section('content')
<section class="login-page">
    <div class="login-container">
        <div class="login-image">
            <img src="{{ asset('img/bg-login.png') }}" alt="Login Illustration">
        </div>

        <div class="login-form">
            <h2>Selamat Datang<br>di Login Admin</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" name="role" value="master">

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="email" placeholder="Masukkan Email Anda" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <div class="input-error">{{ $message }}</div>
                @enderror

                <div class="input-group pass_show">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Masukkan Password Anda" required>
                    <span class="ptxt">Show</span>
                </div>
                @error('password')
                    <div class="input-error">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn-login">Log In</button>

            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('login_error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Login Gagal',
        text: '{{ session('login_error') }}',
    });
</script>
@endif

<script>
    $(document).ready(function(){
        $('.pass_show .ptxt').on('click', function(){
            const input = $(this).siblings('input');
            const isPassword = input.attr('type') === 'password';

            $(this).text(isPassword ? 'Hide' : 'Show');
            input.attr('type', isPassword ? 'text' : 'password');
        });
    });
</script>
@endpush
