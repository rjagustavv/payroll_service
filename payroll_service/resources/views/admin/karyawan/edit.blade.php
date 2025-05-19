{{-- resources/views/karyawan/edit.blade.php --}}

@extends('layouts.app') {{-- Asumsi Anda punya layout utama, sesuaikan jika beda --}}

@section('title', 'Edit Karyawan')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Data Karyawan: {{ $karyawan->nama }}</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.karyawan.update', $karyawan->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT') {{-- Method spoofing untuk request PUT --}}

                            <div class="mb-3">
                                <label for="nomor_induk_karyawan" class="form-label">Nomor Induk Karyawan (NIK)</label>
                                <input type="text" class="form-control @error('nomor_induk_karyawan') is-invalid @enderror"
                                    id="nomor_induk_karyawan" name="nomor_induk_karyawan"
                                    value="{{ old('nomor_induk_karyawan', $karyawan->nomor_induk_karyawan) }}" required>
                                @error('nomor_induk_karyawan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ old('nama', $karyawan->nama) }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email', $karyawan->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="telepon" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon"
                                    name="telepon" value="{{ old('telepon', $karyawan->telepon) }}">
                                @error('telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan"
                                    name="jabatan" value="{{ old('jabatan', $karyawan->jabatan) }}" required>
                                @error('jabatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="departemen" class="form-label">Departemen</label>
                                <input type="text" class="form-control @error('departemen') is-invalid @enderror"
                                    id="departemen" name="departemen"
                                    value="{{ old('departemen', $karyawan->departemen) }}">
                                @error('departemen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                    id="tanggal_masuk" name="tanggal_masuk"
                                    value="{{ old('tanggal_masuk', $karyawan->tanggal_masuk ? \Carbon\Carbon::parse($karyawan->tanggal_masuk)->format('Y-m-d') : '') }}">
                                @error('tanggal_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="gaji" class="form-label">Gaji</label>
                                <input type="number" class="form-control @error('gaji') is-invalid @enderror" id="gaji"
                                    name="gaji" value="{{ old('gaji', $karyawan->gaji) }}" step="any">
                                @error('gaji')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    name="alamat" rows="3">{{ old('alamat', $karyawan->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto Karyawan (Opsional)</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                    name="foto" onchange="previewImage()">
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($karyawan->foto)
                                    <img id="img-preview" src="{{ asset('storage/foto_karyawan/' . $karyawan->foto) }}"
                                        alt="Foto Karyawan" class="img-thumbnail mt-2" style="max-height: 150px;">
                                @else
                                    <img id="img-preview" src="#" alt="Preview Foto" class="img-thumbnail mt-2"
                                        style="max-height: 150px; display: none;">
                                @endif
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('#img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function (oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection

{{-- Tambahan CSS jika diperlukan (misalnya di dalam <style>
    atau file css terpisah) --
    }
    }

    @push('styles') <style>.card-header {
        background-color: #007bff;
        color: white;
    }
</style>
@endpush

{{-- Tambahan JS jika diperlukan (misalnya untuk datepicker, select2, dll) --}}
@push('scripts')
    {{-- Contoh jika Anda menggunakan Font Awesome untuk ikon --}}
    {{--
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script> --}}
@endpush