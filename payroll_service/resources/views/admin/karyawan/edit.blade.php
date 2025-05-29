@extends('layouts.app')

@section('title', 'Edit Karyawan')

@section('page-title', 'Edit Data Karyawan')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 d-flex align-items-center">
            <i class="fas fa-user-edit me-2 text-primary"></i>
            Edit Data: <span class="fw-bold ms-2">{{ $karyawan->nama }}</span>
        </h5>
        <a href="{{ route('admin.karyawan.index') }}" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.karyawan.update', $karyawan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <!-- Informasi Utama -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header bg-primary bg-opacity-10 text-primary">
                            <i class="fas fa-info-circle me-2"></i> Informasi Utama
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nomor_induk_karyawan" class="form-label">
                                            <i class="fas fa-id-badge me-2 text-primary"></i>Nomor Induk Karyawan (NIK)
                                        </label>
                                        <input type="text" class="form-control @error('nomor_induk_karyawan') is-invalid @enderror" 
                                               id="nomor_induk_karyawan" name="nomor_induk_karyawan" 
                                               value="{{ old('nomor_induk_karyawan', $karyawan->nomor_induk_karyawan) }}" required>
                                        @error('nomor_induk_karyawan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">
                                            <i class="fas fa-user me-2 text-primary"></i>Nama Lengkap
                                        </label>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                               id="nama" name="nama" 
                                               value="{{ old('nama', $karyawan->nama) }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">
                                            <i class="fas fa-envelope me-2 text-primary"></i>Email
                                        </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" 
                                               value="{{ old('email', $karyawan->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="telepon" class="form-label">
                                            <i class="fas fa-phone me-2 text-primary"></i>Nomor Telepon
                                        </label>
                                        <input type="text" class="form-control @error('telepon') is-invalid @enderror" 
                                               id="telepon" name="telepon" 
                                               value="{{ old('telepon', $karyawan->telepon) }}">
                                        @error('telepon')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informasi Pekerjaan -->
                    <div class="card mt-4">
                        <div class="card-header bg-success bg-opacity-10 text-success">
                            <i class="fas fa-briefcase me-2"></i> Informasi Pekerjaan
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jabatan" class="form-label">
                                            <i class="fas fa-user-tie me-2 text-success"></i>Jabatan
                                        </label>
                                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror" 
                                               id="jabatan" name="jabatan" 
                                               value="{{ old('jabatan', $karyawan->jabatan) }}" required>
                                        @error('jabatan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="departemen" class="form-label">
                                            <i class="fas fa-building me-2 text-success"></i>Departemen
                                        </label>
                                        <input type="text" class="form-control @error('departemen') is-invalid @enderror" 
                                               id="departemen" name="departemen" 
                                               value="{{ old('departemen', $karyawan->departemen) }}">
                                        @error('departemen')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_masuk" class="form-label">
                                            <i class="fas fa-calendar-alt me-2 text-success"></i>Tanggal Masuk
                                        </label>
                                        <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" 
                                               id="tanggal_masuk" name="tanggal_masuk" 
                                               value="{{ old('tanggal_masuk', $karyawan->tanggal_masuk ? \Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('Y-m-d') : '') }}">
                                        @error('tanggal_masuk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="gaji" class="form-label">
                                            <i class="fas fa-money-bill-wave me-2 text-success"></i>Gaji
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control @error('gaji') is-invalid @enderror" 
                                                   id="gaji" name="gaji" 
                                                   value="{{ old('gaji', $karyawan->gaji) }}" step="any">
                                            @error('gaji')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="alamat" class="form-label">
                                            <i class="fas fa-map-marker-alt me-2 text-success"></i>Alamat
                                        </label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                                  id="alamat" name="alamat" rows="3">{{ old('alamat', $karyawan->alamat) }}</textarea>
                                        @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Foto Karyawan -->
                <div class="col-lg-4">
                    <div class="card h-100">
                        <div class="card-header bg-info bg-opacity-10 text-info">
                            <i class="fas fa-image me-2"></i> Foto Karyawan
                        </div>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="text-center mb-3">
                                @if($karyawan->foto)
                                    <img id="img-preview" src="{{ asset('storage/foto_karyawan/' . $karyawan->foto) }}" 
                                         alt="Foto {{ $karyawan->nama }}" class="img-fluid rounded shadow-sm" 
                                         style="max-height: 250px; object-fit: cover;">
                                @else
                                    <div id="no-image" class="text-center p-5 rounded bg-light mb-3">
                                        <i class="fas fa-user fa-5x text-secondary opacity-50"></i>
                                        <p class="mt-3 text-muted">Belum ada foto</p>
                                    </div>
                                    <img id="img-preview" src="#" alt="Preview Foto" class="img-fluid rounded shadow-sm" 
                                         style="max-height: 250px; object-fit: cover; display: none;">
                                @endif
                            </div>
                            
                            <div class="mb-3 w-100">
                                <label for="foto" class="form-label d-flex align-items-center">
                                    <i class="fas fa-upload me-2 text-info"></i>Upload Foto Baru
                                </label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" 
                                       id="foto" name="foto" accept="image/*" onchange="previewImage()">
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-muted">
                                    <i class="fas fa-info-circle me-1"></i> Format: JPG, PNG, GIF. Maks: 2MB
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
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage() {
        const image = document.querySelector('#foto');
        const imgPreview = document.querySelector('#img-preview');
        const noImage = document.querySelector('#no-image');
        
        if (image.files && image.files[0]) {
            const oFReader = new FileReader();
            
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
                imgPreview.style.display = 'block';
                
                if (noImage) {
                    noImage.style.display = 'none';
                }
            }
            
            oFReader.readAsDataURL(image.files[0]);
        }
    }
    
    // Format currency for gaji
    const gajiInput = document.getElementById('gaji');
    gajiInput.addEventListener('blur', function() {
        if (this.value) {
            this.value = parseFloat(this.value).toFixed(2);
        }
    });
</script>
@endpush
