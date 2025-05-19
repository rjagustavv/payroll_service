@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- Left side - Background image and content -->
            <div class="col-lg-6 d-none d-lg-flex position-relative p-0">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-primary"
                    style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);"></div>
                <div
                    class="position-relative d-flex flex-column justify-content-center align-items-center text-white p-5 w-100">
                    <div class="text-center mb-5">
                        <h1 class="display-4 fw-bold mb-4">Selamat Datang!</h1>
                        <p class="lead mb-4">Silahkan login untuk mengakses sistem absensi dan manajemen karyawan.</p>
                        <div class="d-flex justify-content-center mt-5">
                            <div class="bg-white rounded-circle p-3 shadow-sm mx-2">
                                <i class="fas fa-user-check text-primary fs-4"></i>
                            </div>
                            <div class="bg-white rounded-circle p-3 shadow-sm mx-2">
                                <i class="fas fa-calendar-check text-primary fs-4"></i>
                            </div>
                            <div class="bg-white rounded-circle p-3 shadow-sm mx-2">
                                <i class="fas fa-chart-bar text-primary fs-4"></i>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute bottom-0 start-0 w-100 p-4 text-center">
                        <p class="mb-0 small">© {{ date('Y') }} Sistem Absensi Karyawan. All rights reserved.</p>
                    </div>
                </div>
            </div>

            <!-- Right side - Login form -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white">
                <div class="w-100 p-4 p-md-5" style="max-width: 450px;">
                    <div class="text-center mb-5">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" height="70" class="mb-4"
                            onerror="this.src='https://via.placeholder.com/200x70?text=LOGO'; this.onerror=null;">
                        <h2 class="fw-bold">Masuk ke Akun Anda</h2>
                        <p class="text-muted">Masukkan kredensial Anda untuk melanjutkan</p>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-envelope text-muted"></i>
                                </span>
                                <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" placeholder="nama@perusahaan.com"
                                    required autofocus>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <a href="#" class="text-decoration-none small">Lupa password?</a>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input type="password"
                                    class="form-control border-start-0 @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="••••••••" required>
                                <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>

                        <div class="d-grid gap-2 mb-4">
                            <button type="submit" class="btn btn-primary py-3 fw-semibold">
                                <i class="fas fa-sign-in-alt me-2"></i> Masuk
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="mb-0">Belum punya akun?
                                <a href="{{ route('register.form') }}" class="text-decoration-none fw-semibold">Registrasi
                                    di sini</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Toggle password visibility
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function () {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                // Toggle eye icon
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });

            // Form validation
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });
    </script>
@endsection