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

            <!-- Form Login -->
            <form method="POST" action="{{ route('akun') }}">
                @csrf
                <input type="hidden" name="role" id="role-input" value="master">

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Masukkan Username Anda" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password-field" placeholder="Masukkan Password Anda" required>
                    <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                </div>                
                
                <button type="submit" class="btn-login">Log In</button>
            </form>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
 const togglePassword = document.getElementById('togglePassword');
const passwordField = document.getElementById('password-field');

togglePassword.addEventListener('click', function () {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    this.classList.toggle('fa-eye-slash');
    this.classList.toggle('fa-eye');
});

</script>
@endsection
