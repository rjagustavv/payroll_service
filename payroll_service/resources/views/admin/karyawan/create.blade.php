@extends('layouts.app')

@section('title', 'Tambah Karyawan')

@section('page-title', 'Tambah Karyawan Baru')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Tambah Karyawan</h5>
            <a href="{{ route('admin.karyawan.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.karyawan.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    <!-- Data Akun -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-primary bg-opacity-10 text-primary">
                                <i class="fas fa-user-circle me-2"></i> Data Akun
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-user me-2 text-primary"></i>Nama Lengkap
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope me-2 text-primary"></i>Email
                                    </label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" value="{{ old('email') }}" placeholder="nama@perusahaan.com" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-2 text-primary"></i>Password
                                    </label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Minimal 8 karakter" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="fas fa-lock me-2 text-primary"></i>Konfirmasi Password
                                    </label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Ulangi password" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Karyawan -->
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-success bg-opacity-10 text-success">
                                <i class="fas fa-id-card me-2"></i> Data Karyawan
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="nik" class="form-label">
                                        <i class="fas fa-id-badge me-2 text-success"></i>NIK
                                    </label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                        name="nik" value="{{ old('nik') }}" placeholder="Nomor Induk Karyawan" required>
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="posisi" class="form-label">
                                        <i class="fas fa-briefcase me-2 text-success"></i>Posisi
                                    </label>
                                    <input type="text" class="form-control @error('posisi') is-invalid @enderror"
                                        id="posisi" name="posisi" value="{{ old('posisi') }}" placeholder="Jabatan/Posisi"
                                        required>
                                    @error('posisi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="gaji_pokok" class="form-label">
                                        <i class="fas fa-money-bill-wave me-2 text-success"></i>Gaji Pokok
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" step="0.01"
                                            class="form-control @error('gaji_pokok') is-invalid @enderror" id="gaji_pokok"
                                            name="gaji_pokok" value="{{ old('gaji_pokok') }}" placeholder="0.00" required>
                                        @error('gaji_pokok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_masuk" class="form-label">
                                        <i class="fas fa-calendar-alt me-2 text-success"></i>Tanggal Masuk
                                    </label>
                                    <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                        id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required>
                                    @error('tanggal_masuk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Kontak -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-info bg-opacity-10 text-info">
                                <i class="fas fa-address-book me-2"></i> Informasi Kontak
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="no_telepon" class="form-label">
                                                <i class="fas fa-phone me-2 text-info"></i>No. Telepon
                                            </label>
                                            <input type="text"
                                                class="form-control @error('no_telepon') is-invalid @enderror"
                                                id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}"
                                                placeholder="+62 812-3456-7890">
                                            @error('no_telepon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">
                                                <i class="fas fa-map-marker-alt me-2 text-info"></i>Alamat
                                            </label>
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                                name="alamat" rows="3"
                                                placeholder="Alamat lengkap karyawan">{{ old('alamat') }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Karyawan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Form validation
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');

            form.addEventListener('submit', function (event) {
                let isValid = true;

                // Add any custom validation logic here
                const password = document.getElementById('password');
                const passwordConfirm = document.getElementById('password_confirmation');

                if (password.value !== passwordConfirm.value) {
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback d-block';
                    errorDiv.textContent = 'Password dan konfirmasi password tidak cocok';
                    passwordConfirm.classList.add('is-invalid');

                    // Remove any existing error message
                    const existingError = passwordConfirm.nextElementSibling;
                    if (existingError && existingError.className === 'invalid-feedback d-block') {
                        existingError.remove();
                    }

                    passwordConfirm.parentNode.appendChild(errorDiv);
                    isValid = false;
                }

                if (!isValid) {
                    event.preventDefault();
                } else {
                    // Show loading state
                    const submitBtn = form.querySelector('button[type="submit"]');
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Menyimpan...';
                    submitBtn.disabled = true;
                }
            });

            // Format currency for gaji_pokok
            const gajiInput = document.getElementById('gaji_pokok');
            gajiInput.addEventListener('blur', function () {
                if (this.value) {
                    this.value = parseFloat(this.value).toFixed(2);
                }
            });
        });
    </script>
@endsection