@extends('layouts.app')

@section('title', 'Registrasi Karyawan Baru')

@section('content')
<div class="container-fluid">
    <div class="row min-vh-100">
        <!-- Left side - Background image and content -->
        <div class="col-lg-5 d-none d-lg-flex position-relative p-0">
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient-primary" style="background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%);"></div>
            <div class="position-relative d-flex flex-column justify-content-center align-items-center text-white p-5 w-100">
                <div class="text-center mb-5">
                    <h1 class="display-4 fw-bold mb-4">Bergabunglah Dengan Kami!</h1>
                    <p class="lead mb-4">Daftarkan diri Anda sebagai karyawan baru dan mulai perjalanan karir Anda bersama kami.</p>
                    <div class="d-flex justify-content-center mt-5">
                        <div class="bg-white rounded-circle p-3 shadow-sm mx-2">
                            <i class="fas fa-user-plus text-primary fs-4"></i>
                        </div>
                        <div class="bg-white rounded-circle p-3 shadow-sm mx-2">
                            <i class="fas fa-briefcase text-primary fs-4"></i>
                        </div>
                        <div class="bg-white rounded-circle p-3 shadow-sm mx-2">
                            <i class="fas fa-chart-line text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 p-4 text-center">
                    <p class="mb-0 small">© {{ date('Y') }} Sistem Manajemen Karyawan. All rights reserved.</p>
                </div>
            </div>
        </div>
        
        <!-- Right side - Registration form -->
        <div class="col-lg-7 bg-light">
            <div class="container py-5">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" height="60" class="mb-3" 
                         onerror="this.src='https://via.placeholder.com/180x60?text=Your+Logo'; this.onerror=null;">
                    <h2 class="fw-bold">Registrasi Karyawan Baru</h2>
                    <p class="text-muted">Lengkapi formulir di bawah ini untuk mendaftar</p>
                </div>
                
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
                            @csrf
                            
                            <!-- Progress bar -->
                            <div class="mb-4">
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" id="formProgress"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-1">
                                    <span class="badge rounded-pill bg-primary" id="step1Badge">1. Akun</span>
                                    <span class="badge rounded-pill bg-secondary" id="step2Badge">2. Informasi Karyawan</span>
                                </div>
                            </div>
                            
                            <!-- Step 1: Account Information -->
                            <div id="step1" class="form-step">
                                <h5 class="card-title mb-4">
                                    <i class="fas fa-user-circle me-2 text-primary"></i>
                                    Informasi Akun
                                </h5>
                                
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0 @error('name') is-invalid @enderror" 
                                            id="name" name="name" value="{{ old('name') }}" required autofocus>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Alamat Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                            id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror" 
                                            id="password" name="password" required>
                                        <button class="btn btn-outline-secondary border-start-0" type="button" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="password-strength mt-2 d-none" id="passwordStrength">
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 0%;" id="passwordStrengthBar"></div>
                                        </div>
                                        <small class="text-muted" id="passwordStrengthText">Password strength</small>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input type="password" class="form-control border-start-0" 
                                            id="password_confirmation" name="password_confirmation" required>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="button" class="btn btn-primary px-4" id="nextStep">
                                        Lanjutkan <i class="fas fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Step 2: Employee Information -->
                            <div id="step2" class="form-step d-none">
                                <h5 class="card-title mb-4">
                                    <i class="fas fa-id-card me-2 text-primary"></i>
                                    Informasi Karyawan
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nik" class="form-label fw-semibold">NIK (Nomor Induk Karyawan)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-id-badge text-muted"></i>
                                            </span>
                                            <input type="text" class="form-control border-start-0 @error('nik') is-invalid @enderror" 
                                                id="nik" name="nik" value="{{ old('nik') }}" required>
                                            @error('nik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="posisi" class="form-label fw-semibold">Posisi / Jabatan</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-briefcase text-muted"></i>
                                            </span>
                                            <input type="text" class="form-control border-start-0 @error('posisi') is-invalid @enderror" 
                                                id="posisi" name="posisi" value="{{ old('posisi') }}" required>
                                            @error('posisi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_masuk" class="form-label fw-semibold">Tanggal Masuk Kerja</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-calendar-alt text-muted"></i>
                                            </span>
                                            <input type="date" class="form-control border-start-0 @error('tanggal_masuk') is-invalid @enderror" 
                                                id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required>
                                            @error('tanggal_masuk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="gaji_pokok" class="form-label fw-semibold">Gaji Pokok</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-money-bill-wave text-muted"></i>
                                            </span>
                                            <input type="number" step="1000" class="form-control border-start-0 @error('gaji_pokok') is-invalid @enderror" 
                                                id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok') }}" required placeholder="Contoh: 5000000">
                                            @error('gaji_pokok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div id="gajiHelp" class="form-text">Masukkan angka tanpa titik atau koma.</div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="no_telepon" class="form-label fw-semibold">Nomor Telepon (Opsional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-phone text-muted"></i>
                                        </span>
                                        <input type="text" class="form-control border-start-0 @error('no_telepon') is-invalid @enderror" 
                                            id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}">
                                        @error('no_telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="alamat" class="form-label fw-semibold">Alamat (Opsional)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-home text-muted"></i>
                                        </span>
                                        <textarea class="form-control border-start-0 @error('alamat') is-invalid @enderror" 
                                            id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-outline-secondary px-4" id="prevStep">
                                        <i class="fas fa-arrow-left me-2"></i> Kembali
                                    </button>
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-user-plus me-2"></i> Daftar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <p class="mb-0">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Login di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        
        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // Toggle eye icon
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
        
        // Multi-step form
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const nextStep = document.getElementById('nextStep');
        const prevStep = document.getElementById('prevStep');
        const formProgress = document.getElementById('formProgress');
        const step1Badge = document.getElementById('step1Badge');
        const step2Badge = document.getElementById('step2Badge');
        
        nextStep.addEventListener('click', function() {
            // Validate first step
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');
            
            let isValid = true;
            
            if (!name.value) {
                name.classList.add('is-invalid');
                isValid = false;
            } else {
                name.classList.remove('is-invalid');
            }
            
            if (!email.value || !email.value.includes('@')) {
                email.classList.add('is-invalid');
                isValid = false;
            } else {
                email.classList.remove('is-invalid');
            }
            
            if (!password.value || password.value.length < 8) {
                password.classList.add('is-invalid');
                isValid = false;
            } else {
                password.classList.remove('is-invalid');
            }
            
            if (!passwordConfirmation.value || passwordConfirmation.value !== password.value) {
                passwordConfirmation.classList.add('is-invalid');
                isValid = false;
            } else {
                passwordConfirmation.classList.remove('is-invalid');
            }
            
            if (isValid) {
                step1.classList.add('d-none');
                step2.classList.remove('d-none');
                formProgress.style.width = '100%';
                step1Badge.classList.remove('bg-primary');
                step1Badge.classList.add('bg-success');
                step2Badge.classList.remove('bg-secondary');
                step2Badge.classList.add('bg-primary');
            }
        });
        
        prevStep.addEventListener('click', function() {
            step2.classList.add('d-none');
            step1.classList.remove('d-none');
            formProgress.style.width = '0%';
            step1Badge.classList.add('bg-primary');
            step1Badge.classList.remove('bg-success');
            step2Badge.classList.add('bg-secondary');
            step2Badge.classList.remove('bg-primary');
        });
        
        // Password strength meter
        const passwordInput = document.getElementById('password');
        const passwordStrength = document.getElementById('passwordStrength');
        const passwordStrengthBar = document.getElementById('passwordStrengthBar');
        const passwordStrengthText = document.getElementById('passwordStrengthText');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            
            if (password.length > 0) {
                passwordStrength.classList.remove('d-none');
                
                // Calculate password strength
                let strength = 0;
                
                // Length check
                if (password.length >= 8) strength += 25;
                
                // Contains lowercase
                if (/[a-z]/.test(password)) strength += 25;
                
                // Contains uppercase
                if (/[A-Z]/.test(password)) strength += 25;
                
                // Contains number or special char
                if (/[0-9!@#$%^&*]/.test(password)) strength += 25;
                
                // Update UI
                passwordStrengthBar.style.width = strength + '%';
                
                if (strength < 50) {
                    passwordStrengthBar.className = 'progress-bar bg-danger';
                    passwordStrengthText.textContent = 'Password lemah';
                } else if (strength < 75) {
                    passwordStrengthBar.className = 'progress-bar bg-warning';
                    passwordStrengthText.textContent = 'Password sedang';
                } else {
                    passwordStrengthBar.className = 'progress-bar bg-success';
                    passwordStrengthText.textContent = 'Password kuat';
                }
            } else {
                passwordStrength.classList.add('d-none');
            }
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
