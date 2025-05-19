@extends('layouts.app')

@section('title', 'Kelola Karyawan')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                        <i class="fas fa-users text-primary fs-4"></i>
                    </div>
                    <div>
                        <h4 class="mb-0">Kelola Karyawan</h4>
                        <p class="text-muted mb-0">Manajemen data karyawan perusahaan</p>
                    </div>
                    <div class="ms-auto">
                        <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus me-2"></i> Tambah Karyawan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-primary bg-opacity-10 mb-3">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary p-3 me-3">
                            <i class="fas fa-users text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Karyawan</h6>
                            <h4 class="mb-0">{{ $karyawans->total() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-success bg-opacity-10 mb-3">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-success p-3 me-3">
                            <i class="fas fa-user-tie text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Karyawan Aktif</h6>
                            <h4 class="mb-0">{{ $karyawans->total() }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-info bg-opacity-10 mb-3">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-info p-3 me-3">
                            <i class="fas fa-briefcase text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Departemen</h6>
                            <h4 class="mb-0">5</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-warning bg-opacity-10 mb-3">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-warning p-3 me-3">
                            <i class="fas fa-money-bill-wave text-white"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Gaji</h6>
                            <h4 class="mb-0">Rp {{ number_format($karyawans->sum('gaji_pokok'), 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.karyawan.index') }}" class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" name="search" class="form-control border-start-0" 
                                    placeholder="Cari NIK atau Nama Karyawan..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="posisi" class="form-select">
                                <option value="">Semua Posisi</option>
                                <option value="Manager" {{ request('posisi') == 'Manager' ? 'selected' : '' }}>Manager</option>
                                <option value="Staff" {{ request('posisi') == 'Staff' ? 'selected' : '' }}>Staff</option>
                                <option value="Supervisor" {{ request('posisi') == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
                                <!-- Tambahkan posisi lainnya sesuai kebutuhan -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div class="d-grid">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-filter me-2"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-table me-2 text-primary"></i>
                        Daftar Karyawan
                    </h5>
                    <div>
                        <button class="btn btn-sm btn-outline-success me-2">
                            <i class="fas fa-file-excel me-1"></i> Export Excel
                        </button>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-file-pdf me-1"></i> Export PDF
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-3 py-3">NIK</th>
                                    <th class="px-3 py-3">Nama</th>
                                    <th class="px-3 py-3">Email</th>
                                    <th class="px-3 py-3">Posisi</th>
                                    <th class="px-3 py-3">Gaji Pokok</th>
                                    <th class="px-3 py-3">Status</th>
                                    <th class="px-3 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($karyawans as $karyawan)
                                    <tr>
                                        <td class="px-3 py-3">{{ $karyawan->nik }}</td>
                                        <td class="px-3 py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary text-white rounded-circle p-2 me-2" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                                    {{ substr($karyawan->user->name ?? 'N/A', 0, 1) }}
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $karyawan->user->name ?? 'N/A' }}</h6>
                                                    <small class="text-muted">{{ $karyawan->no_telepon ?? 'No. Telp tidak tersedia' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-3 py-3">{{ $karyawan->user->email ?? 'N/A' }}</td>
                                        <td class="px-3 py-3">
                                            <span class="badge bg-info text-dark">{{ $karyawan->posisi }}</span>
                                        </td>
                                        <td class="px-3 py-3">
                                            <span class="fw-semibold">Rp {{ number_format($karyawan->gaji_pokok, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="px-3 py-3">
                                            <span class="badge bg-success">Aktif</span>
                                        </td>
                                        <td class="px-3 py-3 text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('admin.karyawan.edit', $karyawan->id) }}">
                                                            <i class="fas fa-edit text-warning me-2"></i> Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $karyawan->id }}">
                                                            <i class="fas fa-eye text-info me-2"></i> Detail
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <form action="{{ route('admin.karyawan.destroy', $karyawan->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Yakin ingin menghapus karyawan ini?');">
                                                                <i class="fas fa-trash-alt text-danger me-2"></i> Hapus
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                            
                                            <!-- Detail Modal -->
                                            <div class="modal fade" id="detailModal{{ $karyawan->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $karyawan->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="detailModalLabel{{ $karyawan->id }}">Detail Karyawan</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center mb-4">
                                                                <div class="bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2rem;">
                                                                    {{ substr($karyawan->user->name ?? 'N/A', 0, 1) }}
                                                                </div>
                                                                <h5 class="mb-1">{{ $karyawan->user->name ?? 'N/A' }}</h5>
                                                                <p class="text-muted mb-0">{{ $karyawan->posisi }}</p>
                                                            </div>
                                                            
                                                            <div class="row g-3">
                                                                <div class="col-6">
                                                                    <p class="mb-1 text-muted small">NIK</p>
                                                                    <p class="mb-0 fw-semibold">{{ $karyawan->nik }}</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <p class="mb-1 text-muted small">Email</p>
                                                                    <p class="mb-0 fw-semibold">{{ $karyawan->user->email ?? 'N/A' }}</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <p class="mb-1 text-muted small">No. Telepon</p>
                                                                    <p class="mb-0 fw-semibold">{{ $karyawan->no_telepon ?? '-' }}</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <p class="mb-1 text-muted small">Tanggal Masuk</p>
                                                                    <p class="mb-0 fw-semibold">{{ $karyawan->tanggal_masuk ? date('d M Y', strtotime($karyawan->tanggal_masuk)) : '-' }}</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <p class="mb-1 text-muted small">Gaji Pokok</p>
                                                                    <p class="mb-0 fw-semibold">Rp {{ number_format($karyawan->gaji_pokok, 0, ',', '.') }}</p>
                                                                </div>
                                                                <div class="col-6">
                                                                    <p class="mb-1 text-muted small">Status</p>
                                                                    <p class="mb-0"><span class="badge bg-success">Aktif</span></p>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="mb-1 text-muted small">Alamat</p>
                                                                    <p class="mb-0 fw-semibold">{{ $karyawan->alamat ?? '-' }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                            <a href="{{ route('admin.karyawan.edit', $karyawan->id) }}" class="btn btn-primary">Edit Karyawan</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-user-slash text-muted mb-3" style="font-size: 3rem;"></i>
                                                <h5 class="text-muted">Tidak ada data karyawan</h5>
                                                <p class="text-muted">Belum ada karyawan yang terdaftar dalam sistem</p>
                                                <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary mt-2">
                                                    <i class="fas fa-user-plus me-2"></i> Tambah Karyawan Baru
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted">Menampilkan {{ $karyawans->firstItem() ?? 0 }} - {{ $karyawans->lastItem() ?? 0 }} dari {{ $karyawans->total() }} data</span>
                        </div>
                        <div>
                            {{ $karyawans->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection
