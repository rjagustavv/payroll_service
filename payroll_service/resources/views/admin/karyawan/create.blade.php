@extends('layouts.app')

@section('title', 'Tambah Karyawan')

@section('content')
    <h1>Tambah Karyawan Baru</h1>
    <form action="{{ route('admin.karyawan.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <fieldset>
                    <legend>Data Akun</legend>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            value="{{ old('name') }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                            required>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset>
                    <legend>Data Karyawan</legend>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik"
                            value="{{ old('nik') }}" required>
                        @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="posisi" class="form-label">Posisi</label>
                        <input type="text" class="form-control @error('posisi') is-invalid @enderror" id="posisi"
                            name="posisi" value="{{ old('posisi') }}" required>
                        @error('posisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                        <input type="number" step="0.01" class="form-control @error('gaji_pokok') is-invalid @enderror"
                            id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok') }}" required>
                        @error('gaji_pokok') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror"
                            id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required>
                        @error('tanggal_masuk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_telepon" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon"
                            name="no_telepon" value="{{ old('no_telepon') }}">
                        @error('no_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                            rows="3">{{ old('alamat') }}</textarea>
                        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </fieldset>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan Karyawan</button>
        <a href="{{ route('admin.karyawan.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
@endsection