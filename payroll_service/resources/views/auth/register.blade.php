@extends('layouts.app')

@section('title', 'Registrasi Karyawan Baru')

@section('content')
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --card-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        }

        .hero-section {
            background: var(--primary-gradient);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .floating-icons {
            animation: float 6s ease-in-out infinite;
        }

        .floating-icons:nth-child(2) {
            animation-delay: -2s;
        }

        .floating-icons:nth-child(3) {
            animation-delay: -4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--card-shadow);
            border-radius: 20px;
            transition: all 0.3s ease;
        }

        .form-card:hover {
            box-shadow: var(--hover-shadow);
            transform: translateY(-5px);
        }

        .section-card {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 15px;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
        }

        .section-card:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .section-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px 15px 0 0;
            padding: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .section-header.account {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            color: #667eea;
        }

        .section-header.employee {
            background: linear-gradient(135deg, rgba(40, 167, 69, 0.1) 0%, rgba(32, 201, 151, 0.1) 100%);
            color: #28a745;
        }

        .input-group-text {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 1px solid #dee2e6;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .form-control {
            border: 1px solid #dee2e6;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
            background: white;
        }

        .form-control:focus+.input-group-text,
        .input-group-text:has(+ .form-control:focus) {
            border-color: #667eea;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            padding: 15px 40px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-size: 1.1rem;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
        }

        .password-strength {
            transition: all 0.3s ease;
        }

        .strength-weak {
            color: #dc3545;
        }

        .strength-medium {
            color: #ffc107;
        }

        .strength-strong {
            color: #28a745;
        }

        .logo-container {
            background: white;
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            display: inline-block;
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
            animation: slideDown 0.5s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 991.98px) {
            .hero-section {
                min-height: 300px;
            }

            .form-card {
                margin: 20px;
            }
        }

        .ripple {
            position: relative;
            overflow: hidden;
        }

        .ripple::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .ripple:active::after {
            width: 300px;
            height: 300px;
        }

        .form-section {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="container-fluid p-0">
        <div class="row min-vh-100 g-0">
            <!-- Left side - Hero Section -->
            <div class="col-lg-5 d-none d-lg-flex hero-section">
                <div
                    class="position-relative d-flex flex-column justify-content-center align-items-center text-white p-5 w-100 z-index-2">
                    <div class="text-center mb-5">
                        <div class="mb-4">
                            <h1 class="display-3 fw-bold mb-4 text-shadow">
                                Selamat Datang! 👋
                            </h1>
                            <p class="lead mb-4 opacity-90">
                                Bergabunglah dengan tim terbaik kami dan mulai perjalanan karir yang menakjubkan bersama
                                perusahaan yang inovatif.
                            </p>
                        </div>

                        <div class="d-flex justify-content-center gap-4 mb-5">
                            <div class="floating-icons bg-white rounded-circle p-4 shadow-lg">
                                <i class="fas fa-user-plus text-primary fs-2"></i>
                            </div>
                            <div class="floating-icons bg-white rounded-circle p-4 shadow-lg">
                                <i class="fas fa-briefcase text-success fs-2"></i>
                            </div>
                            <div class="floating-icons bg-white rounded-circle p-4 shadow-lg">
                                <i class="fas fa-chart-line text-warning fs-2"></i>
                            </div>
                        </div>

                        <div class="row text-center g-4">
                            <div class="col-4">
                                <div class="bg-blue bg-opacity-20 rounded-3 p-3">
                                    <h3 class="fw-bold mb-1">500+</h3>
                                    <small class="opacity-75">Karyawan</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="bg-blue bg-opacity-20 rounded-3 p-3">
                                    <h3 class="fw-bold mb-1">50+</h3>
                                    <small class="opacity-75">Departemen</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="bg-blue bg-opacity-20 rounded-3 p-3">
                                    <h3 class="fw-bold mb-1">10+</h3>
                                    <small class="opacity-75">Tahun</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="position-absolute bottom-0 start-0 w-100 p-4 text-center">
                        <p class="mb-0 small opacity-75">
                            © {{ date('Y') }} PayrollApp. Semua hak dilindungi undang-undang.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right side - Registration Form -->
            <div class="col-lg-7 bg-light d-flex align-items-center">
                <div class="container py-5">
                    <div class="text-center mb-5">
                        <div class="logo-container">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="50"
                                onerror="this.src='https://via.placeholder.com/150x50/667eea/ffffff?text=PayrollApp'; this.onerror=null;">
                        </div>
                        <h2 class="fw-bold text-dark mb-2">Registrasi Karyawan Baru</h2>
                        <p class="text-muted">Lengkapi semua informasi di bawah ini untuk bergabung dengan tim kami</p>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="fas fa-exclamation-triangle me-3 fs-5"></i>
                            <div>
                                {{ session('error') }}
                            </div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="form-card">
                        <div class="card-body p-0">
                            <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                                @csrf

                                <!-- Informasi Akun Section -->
                                <div class="section-card form-section">
                                    <div class="section-header account">
                                        <h5 class="mb-1 fw-bold d-flex align-items-center">
                                            <i class="fas fa-user-circle me-3 fs-4"></i>
                                            Informasi Akun
                                        </h5>
                                        <p class="mb-0 small opacity-75">Buat akun untuk mengakses sistem</p>
                                    </div>
                                    <div class="p-4">
                                        <div class="row g-4">
                                            <div class="col-12">
                                                <label for="name" class="form-label fw-semibold">
                                                    <i class="fas fa-user me-2 text-primary"></i>Nama Lengkap
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-end-0">
                                                        <i class="fas fa-user text-muted"></i>
                                                    </span>
                                                    <input type="text"
                                                        class="form-control border-start-0 @error('name') is-invalid @enderror"
                                                        id="name" name="name" value="{{ old('name') }}" required autofocus
                                                        placeholder="Masukkan nama lengkap Anda">
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="email" class="form-label fw-semibold">
                                                    <i class="fas fa-envelope me-2 text-primary"></i>Alamat Email
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-end-0">
                                                        <i class="fas fa-envelope text-muted"></i>
                                                    </span>
                                                    <input type="email"
                                                        class="form-control border-start-0 @error('email') is-invalid @enderror"
                                                        id="email" name="email" value="{{ old('email') }}" required
                                                        placeholder="nama@email.com">
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="password" class="form-label fw-semibold">
                                                    <i class="fas fa-lock me-2 text-primary"></i>Password
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-end-0">
                                                        <i class="fas fa-lock text-muted"></i>
                                                    </span>
                                                    <input type="password"
                                                        class="form-control border-start-0 @error('password') is-invalid @enderror"
                                                        id="password" name="password" required
                                                        placeholder="Minimal 8 karakter">
                                                    <button class="btn btn-outline-secondary border-start-0 ripple"
                                                        type="button" id="togglePassword">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="password-strength mt-3 d-none" id="passwordStrength">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <small class="text-muted">Kekuatan Password:</small>
                                                        <small id="passwordStrengthText" class="fw-semibold">Lemah</small>
                                                    </div>
                                                    <div class="progress" style="height: 6px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%;"
                                                            id="passwordStrengthBar"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="password_confirmation" class="form-label fw-semibold">
                                                    <i class="fas fa-check-circle me-2 text-primary"></i>Konfirmasi Password
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-end-0">
                                                        <i class="fas fa-check-circle text-muted"></i>
                                                    </span>
                                                    <input type="password" class="form-control border-start-0"
                                                        id="password_confirmation" name="password_confirmation" required
                                                        placeholder="Ulangi password Anda">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informasi Karyawan Section -->
                                <div class="section-card form-section" style="animation-delay: 0.2s;">
                                    <div class="section-header employee">
                                        <h5 class="mb-1 fw-bold d-flex align-items-center">
                                            <i class="fas fa-id-card me-3 fs-4"></i>
                                            Informasi Karyawan
                                        </h5>
                                        <p class="mb-0 small opacity-75">Data karyawan dan jabatan</p>
                                    </div>
                                    <div class="p-4">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <label for="nik" class="form-label fw-semibold">
                                                    <i class="fas fa-id-badge me-2 text-success"></i>NIK
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-end-0">
                                                        <i class="fas fa-id-badge text-muted"></i>
                                                    </span>
                                                    <input type="text"
                                                        class="form-control border-start-0 @error('nik') is-invalid @enderror"
                                                        id="nik" name="nik" value="{{ old('nik') }}" required
                                                        placeholder="Nomor Induk Karyawan">
                                                    @error('nik')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="posisi" class="form-label fw-semibold">
                                                    <i class="fas fa-briefcase me-2 text-success"></i>Posisi / Jabatan
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-end-0">
                                                        <i class="fas fa-briefcase text-muted"></i>
                                                    </span>
                                                    <input type="text"
                                                        class="form-control border-start-0 @error('posisi') is-invalid @enderror"
                                                        id="posisi" name="posisi" value="{{ old('posisi') }}" required
                                                        placeholder="Jabatan Anda">
                                                    @error('posisi')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="tanggal_masuk" class="form-label fw-semibold">
                                                    <i class="fas fa-calendar-alt me-2 text-success"></i>Tanggal Masuk
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-end-0">
                                                        <i class="fas fa-calendar-alt text-muted"></i>
                                                    </span>
                                                    <input type="date"
                                                        class="form-control border-start-0 @error('tanggal_masuk') is-invalid @enderror"
                                                        id="tanggal_masuk" name="tanggal_masuk"
                                                        value="{{ old('tanggal_masuk') }}" required>
                                                    @error('tanggal_masuk')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="gaji_pokok" class="form-label fw-semibold">
                                                    <i class="fas fa-money-bill-wave me-2 text-success"></i>Gaji Pokok
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-end-0">Rp</span>
                                                    <input type="number" step="1000"
                                                        class="form-control border-start-0 @error('gaji_pokok') is-invalid @enderror"
                                                        id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok') }}"
                                                        required placeholder="5000000">
                                                    @error('gaji_pokok')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-text">
                                                    <i class="fas fa-info-circle me-1"></i>Masukkan angka tanpa titik atau
                                                    koma
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="no_telepon" class="form-label fw-semibold">
                                                    <i class="fas fa-phone me-2 text-success"></i>Nomor Telepon
                                                    <span class="badge bg-secondary ms-2">Opsional</span>
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-end-0">
                                                        <i class="fas fa-phone text-muted"></i>
                                                    </span>
                                                    <input type="text"
                                                        class="form-control border-start-0 @error('no_telepon') is-invalid @enderror"
                                                        id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                                                        placeholder="+62 812-3456-7890">
                                                    @error('no_telepon')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label for="alamat" class="form-label fw-semibold">
                                                    <i class="fas fa-home me-2 text-success"></i>Alamat
                                                    <span class="badge bg-secondary ms-2">Opsional</span>
                                                </label>
                                                <div class="input-group">
                                                    <span class="input-group-text border-end-0 align-items-start pt-3">
                                                        <i class="fas fa-home text-muted"></i>
                                                    </span>
                                                    <textarea
                                                        class="form-control border-start-0 @error('alamat') is-invalid @enderror"
                                                        id="alamat" name="alamat" rows="3"
                                                        placeholder="Alamat lengkap Anda">{{ old('alamat') }}</textarea>
                                                    @error('alamat')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center p-4">
                                    <button type="submit" class="btn btn-primary btn-lg px-5 ripple">
                                        <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <p class="mb-0 text-muted">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold text-primary">
                                Login di sini <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Enhanced password toggle with animation
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.style.transform = 'scale(0.8)';

            setTimeout(() => {
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
                icon.style.transform = 'scale(1)';
            }, 150);
        });

        // Enhanced password strength meter
        const passwordInput = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');
        const passwordStrengthBar = document.getElementById('passwordStrengthBar');
        const passwordStrengthText = document.getElementById('passwordStrengthText');

        passwordInput.addEventListener('input', function () {
            const password = this.value;

            if (password.length > 0) {
                passwordStrength.classList.remove('d-none');

                let strength = 0;
                let strengthText = '';
                let strengthClass = '';

                // Length check
                if (password.length >= 8) strength += 25;
                if (password.length >= 12) strength += 10;

                // Character variety checks
                if (/[a-z]/.test(password)) strength += 15;
                if (/[A-Z]/.test(password)) strength += 15;
                if (/[0-9]/.test(password)) strength += 15;
                if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) strength += 20;

                // Update UI with smooth animation
                passwordStrengthBar.style.width = strength + '%';

                if (strength < 40) {
                    passwordStrengthBar.className = 'progress-bar bg-danger';
                    strengthText = 'Lemah';
                    strengthClass = 'strength-weak';
                } else if (strength < 70) {
                    passwordStrengthBar.className = 'progress-bar bg-warning';
                    strengthText = 'Sedang';
                    strengthClass = 'strength-medium';
                } else {
                    passwordStrengthBar.className = 'progress-bar bg-success';
                    strengthText = 'Kuat';
                    strengthClass = 'strength-strong';
                }

                passwordStrengthText.textContent = strengthText;
                passwordStrengthText.className = 'fw-semibold ' + strengthClass;
            } else {
                passwordStrength.classList.add('d-none');
            }
        });

        // Real-time validation for password confirmation
        document.getElementById('password_confirmation').addEventListener('input', function () {
            const password = document.getElementById('password').value;
            if (this.value && this.value !== password) {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
            } else if (this.value === password && password) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });

        // Form submission with loading state
        const form = document.querySelector('form');
        form.addEventListener('submit', function (e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mendaftarkan...';
            submitBtn.disabled = true;
        });

        // Auto-dismiss alerts
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.remove(), 300);
            }, 5000);
        });

        // Enhanced form validation
        const inputs = document.querySelectorAll('input[required], textarea[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', function () {
                if (this.value.trim()) {
                    this.classList.add('is-valid');
                    this.classList.remove('is-invalid');
                } else {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                }
            });
        });

        // Email validation
        document.getElementById('email').addEventListener('blur', function () {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailRegex.test(this.value)) {
                this.classList.add('is-valid');
                this.classList.remove('is-invalid');
            } else if (this.value) {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
            }
        });
    });
</script>
@endsection