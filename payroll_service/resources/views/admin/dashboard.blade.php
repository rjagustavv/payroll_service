@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container-fluid py-4">
        <!-- Dashboard Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-sm-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold text-dark mb-0">Dashboard Overview</h3>
                        <p class="text-muted mb-0">Welcome back, Admin! Here's what's happening today.</p>
                    </div>
                    <div class="d-flex mt-3 mt-sm-0">
                        <div class="input-group me-2 date-picker" style="width: 180px;">
                            <input type="date" class="form-control form-control-sm border-0 shadow-sm"
                                value="{{ date('Y-m-d') }}">
                            <span class="input-group-text bg-white border-0 shadow-sm"><i
                                    class="fas fa-calendar-alt text-primary"></i></span>
                        </div>
                        <button class="btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-download me-1"></i> Report
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4">
            <!-- Total Employees Card -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 overflow-hidden">
                    <div class="card-body position-relative">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small fw-medium">Total Karyawan</p>
                                <h2 class="mb-0 fw-bold">{{ $jumlahKaryawan }}</h2>
                            </div>
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px;">
                                <i class="fas fa-users text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success bg-opacity-10 text-success me-2 px-2 py-1">
                                    <i class="fas fa-arrow-up me-1"></i>12%
                                </span>
                                <span class="text-muted small">dari bulan lalu</span>
                            </div>
                        </div>
                        <div class="position-absolute bottom-0 start-0 end-0">
                            <div class="progress rounded-0" style="height: 4px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Attendance Card -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 overflow-hidden">
                    <div class="card-body position-relative">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small fw-medium">Absensi Hari Ini</p>
                                <h2 class="mb-0 fw-bold">{{ $absensiHariIni }}</h2>
                            </div>
                            <div class="rounded-circle bg-success bg-opacity-10 p-3 d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px;">
                                <i class="fas fa-clipboard-check text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-success bg-opacity-10 text-success me-2 px-2 py-1">
                                    <i class="fas fa-arrow-up me-1"></i>5%
                                </span>
                                <span class="text-muted small">dari kemarin</span>
                            </div>
                        </div>
                        <div class="position-absolute bottom-0 start-0 end-0">
                            <div class="progress rounded-0" style="height: 4px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Absent Employees Card -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 overflow-hidden">
                    <div class="card-body position-relative">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small fw-medium">Karyawan Tidak Hadir</p>
                                <h2 class="mb-0 fw-bold">{{ $jumlahKaryawan - $absensiHariIni }}</h2>
                            </div>
                            <div class="rounded-circle bg-warning bg-opacity-10 p-3 d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px;">
                                <i class="fas fa-user-clock text-warning fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-danger bg-opacity-10 text-danger me-2 px-2 py-1">
                                    <i class="fas fa-arrow-down me-1"></i>3%
                                </span>
                                <span class="text-muted small">dari kemarin</span>
                            </div>
                        </div>
                        <div class="position-absolute bottom-0 start-0 end-0">
                            <div class="progress rounded-0" style="height: 4px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 15%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Departments Card -->
            <div class="col-sm-6 col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100 overflow-hidden">
                    <div class="card-body position-relative">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="text-muted mb-1 small fw-medium">Total Departemen</p>
                                <h2 class="mb-0 fw-bold">{{ $departemen ?? 8 }}</h2>
                            </div>
                            <div class="rounded-circle bg-info bg-opacity-10 p-3 d-flex align-items-center justify-content-center"
                                style="width: 48px; height: 48px;">
                                <i class="fas fa-building text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex align-items-center">
                                <span class="badge bg-secondary bg-opacity-10 text-secondary me-2 px-2 py-1">
                                    <i class="fas fa-equals me-1"></i>0%
                                </span>
                                <span class="text-muted small">sama dengan bulan lalu</span>
                            </div>
                        </div>
                        <div class="position-absolute bottom-0 start-0 end-0">
                            <div class="progress rounded-0" style="height: 4px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="row mt-4 g-4">
            <!-- Recent Activity Section -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                        <div>
                            <h5 class="mb-0 fw-bold">Aktivitas Terbaru</h5>
                            <p class="text-muted small mb-0">Aktivitas check-in karyawan hari ini</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary active">Hari Ini</button>
                                <button type="button" class="btn btn-sm btn-outline-primary">Minggu Ini</button>
                                <button type="button" class="btn btn-sm btn-outline-primary">Bulan Ini</button>
                            </div>
                            <button class="btn btn-sm btn-icon btn-outline-secondary ms-2" data-bs-toggle="tooltip"
                                title="Refresh">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="ps-4">Karyawan</th>
                                        <th scope="col">Waktu</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Lokasi</th>
                                        <th scope="col" class="text-end pe-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-primary text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px; font-weight: 500;">
                                                    AS
                                                </div>
                                                <div>
                                                    <p class="mb-0 fw-medium">Andi Susanto</p>
                                                    <span class="text-muted small">IT Department</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p class="mb-0 fw-medium">08:05:12</p>
                                                <span class="text-muted small">{{ date('d M Y') }}</span>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success rounded-pill px-3 py-2">Masuk</span></td>
                                        <td>Kantor Pusat</td>
                                        <td class="text-end pe-4">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon btn-outline-secondary"
                                                    data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fas fa-eye me-2"></i>Detail</a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fas fa-edit me-2"></i>Edit</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i
                                                                class="fas fa-trash me-2"></i>Hapus</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-info text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px; font-weight: 500;">
                                                    BW
                                                </div>
                                                <div>
                                                    <p class="mb-0 fw-medium">Budi Wibowo</p>
                                                    <span class="text-muted small">Marketing Department</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p class="mb-0 fw-medium">08:10:45</p>
                                                <span class="text-muted small">{{ date('d M Y') }}</span>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success rounded-pill px-3 py-2">Masuk</span></td>
                                        <td>Kantor Pusat</td>
                                        <td class="text-end pe-4">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon btn-outline-secondary"
                                                    data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fas fa-eye me-2"></i>Detail</a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fas fa-edit me-2"></i>Edit</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i
                                                                class="fas fa-trash me-2"></i>Hapus</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-warning text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px; font-weight: 500;">
                                                    SR
                                                </div>
                                                <div>
                                                    <p class="mb-0 fw-medium">Siti Rahayu</p>
                                                    <span class="text-muted small">HR Department</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p class="mb-0 fw-medium">08:30:22</p>
                                                <span class="text-muted small">{{ date('d M Y') }}</span>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning text-dark rounded-pill px-3 py-2">Terlambat</span>
                                        </td>
                                        <td>Kantor Cabang</td>
                                        <td class="text-end pe-4">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon btn-outline-secondary"
                                                    data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fas fa-eye me-2"></i>Detail</a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fas fa-edit me-2"></i>Edit</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i
                                                                class="fas fa-trash me-2"></i>Hapus</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-danger text-white rounded-circle p-2 me-3 d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px; font-weight: 500;">
                                                    DH
                                                </div>
                                                <div>
                                                    <p class="mb-0 fw-medium">Dewi Handayani</p>
                                                    <span class="text-muted small">Finance Department</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <p class="mb-0 fw-medium">09:15:33</p>
                                                <span class="text-muted small">{{ date('d M Y') }}</span>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-danger rounded-pill px-3 py-2">Sangat Terlambat</span>
                                        </td>
                                        <td>Kantor Pusat</td>
                                        <td class="text-end pe-4">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-icon btn-outline-secondary"
                                                    data-bs-toggle="dropdown">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fas fa-eye me-2"></i>Detail</a></li>
                                                    <li><a class="dropdown-item" href="#"><i
                                                                class="fas fa-edit me-2"></i>Edit</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i
                                                                class="fas fa-trash me-2"></i>Hapus</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center py-3">
                        <p class="text-muted small mb-0">Menampilkan 4 dari 24 aktivitas</p>
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="fas fa-list me-1"></i> Lihat Semua
                        </a>
                    </div>
                </div>
            </div>

            <!-- Department Statistics -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
                        <div>
                            <h5 class="mb-0 fw-bold">Statistik Departemen</h5>
                            <p class="text-muted small mb-0">Tingkat kehadiran per departemen</p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-icon btn-outline-secondary" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-sync-alt me-2"></i>Refresh</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i>Download</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                                    <span class="fw-medium">IT Department</span>
                                </div>
                                <span class="badge bg-primary bg-opacity-10 text-primary px-2">85%</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar"
                                    style="width: 85%; border-radius: 5px;"></div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                                    <span class="fw-medium">Marketing Department</span>
                                </div>
                                <span class="badge bg-success bg-opacity-10 text-success px-2">75%</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 5px;">
                                <div class="progress-bar bg-success" role="progressbar"
                                    style="width: 75%; border-radius: 5px;"></div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="bg-info rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                                    <span class="fw-medium">HR Department</span>
                                </div>
                                <span class="badge bg-info bg-opacity-10 text-info px-2">90%</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 5px;">
                                <div class="progress-bar bg-info" role="progressbar"
                                    style="width: 90%; border-radius: 5px;"></div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                                    <span class="fw-medium">Finance Department</span>
                                </div>
                                <span class="badge bg-warning bg-opacity-10 text-warning px-2">70%</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 5px;">
                                <div class="progress-bar bg-warning" role="progressbar"
                                    style="width: 70%; border-radius: 5px;"></div>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="bg-danger rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                                    <span class="fw-medium">Operations Department</span>
                                </div>
                                <span class="badge bg-danger bg-opacity-10 text-danger px-2">65%</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 5px;">
                                <div class="progress-bar bg-danger" role="progressbar"
                                    style="width: 65%; border-radius: 5px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 text-center py-3">
                        <a href="#" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-chart-bar me-1"></i> Laporan Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Section -->
        <div class="row mt-4 g-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <h5 class="mb-0 fw-bold">Akses Cepat</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                <a href="#" class="text-decoration-none">
                                    <div class="card border-0 shadow-sm text-center h-100 quick-access-card">
                                        <div class="card-body py-4">
                                            <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-flex align-items-center justify-content-center mx-auto mb-3"
                                                style="width: 60px; height: 60px;">
                                                <i class="fas fa-user-plus text-primary fs-4"></i>
                                            </div>
                                            <h6 class="mb-0 fw-medium">Tambah Karyawan</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                <a href="#" class="text-decoration-none">
                                    <div class="card border-0 shadow-sm text-center h-100 quick-access-card">
                                        <div class="card-body py-4">
                                            <div class="rounded-circle bg-success bg-opacity-10 p-3 d-flex align-items-center justify-content-center mx-auto mb-3"
                                                style="width: 60px; height: 60px;">
                                                <i class="fas fa-money-bill-wave text-success fs-4"></i>
                                            </div>
                                            <h6 class="mb-0 fw-medium">Kelola Gaji</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                <a href="#" class="text-decoration-none">
                                    <div class="card border-0 shadow-sm text-center h-100 quick-access-card">
                                        <div class="card-body py-4">
                                            <div class="rounded-circle bg-info bg-opacity-10 p-3 d-flex align-items-center justify-content-center mx-auto mb-3"
                                                style="width: 60px; height: 60px;">
                                                <i class="fas fa-calendar-alt text-info fs-4"></i>
                                            </div>
                                            <h6 class="mb-0 fw-medium">Jadwal Kerja</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                <a href="#" class="text-decoration-none">
                                    <div class="card border-0 shadow-sm text-center h-100 quick-access-card">
                                        <div class="card-body py-4">
                                            <div class="rounded-circle bg-warning bg-opacity-10 p-3 d-flex align-items-center justify-content-center mx-auto mb-3"
                                                style="width: 60px; height: 60px;">
                                                <i class="fas fa-chart-line text-warning fs-4"></i>
                                            </div>
                                            <h6 class="mb-0 fw-medium">Laporan</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                <a href="#" class="text-decoration-none">
                                    <div class="card border-0 shadow-sm text-center h-100 quick-access-card">
                                        <div class="card-body py-4">
                                            <div class="rounded-circle bg-danger bg-opacity-10 p-3 d-flex align-items-center justify-content-center mx-auto mb-3"
                                                style="width: 60px; height: 60px;">
                                                <i class="fas fa-cog text-danger fs-4"></i>
                                            </div>
                                            <h6 class="mb-0 fw-medium">Pengaturan</h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                <a href="#" class="text-decoration-none">
                                    <div class="card border-0 shadow-sm text-center h-100 quick-access-card">
                                        <div class="card-body py-4">
                                            <div class="rounded-circle bg-secondary bg-opacity-10 p-3 d-flex align-items-center justify-content-center mx-auto mb-3"
                                                style="width: 60px; height: 60px;">
                                                <i class="fas fa-question-circle text-secondary fs-4"></i>
                                            </div>
                                            <h6 class="mb-0 fw-medium">Bantuan</h6>
                                        </div>
                                    </div>
                                </a>
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
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Add hover effect to quick access cards
        document.querySelectorAll('.quick-access-card').forEach(card => {
            card.addEventListener('mouseenter', function () {
                this.classList.add('shadow');
                this.style.transform = 'translateY(-5px)';
                this.style.transition = 'all 0.3s ease';
            });

            card.addEventListener('mouseleave', function () {
                this.classList.remove('shadow');
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
@endsection