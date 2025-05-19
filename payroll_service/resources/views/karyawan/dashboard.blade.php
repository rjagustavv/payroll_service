@extends('layouts.app')

@section('title', 'Dashboard Karyawan')

@section('page-title', 'Dashboard Karyawan')

@section('content')
<div class="row">
    <!-- Welcome Card -->
    <div class="col-12 mb-4">
        <div class="card border-0 bg-primary text-white overflow-hidden">
            <div class="card-body position-relative py-4">
                <div class="row">
                    <div class="col-lg-8">
                        <h2 class="display-6 fw-bold mb-1">Selamat Datang, {{ Auth::user()->name }}!</h2>
                        <p class="fs-5 opacity-75 mb-3">{{ $karyawan->posisi }}</p>
                        <div class="d-flex align-items-center">
                            <div class="bg-white bg-opacity-25 px-3 py-2 rounded-pill">
                                <i class="fas fa-calendar-day me-2"></i>
                                {{ \Carbon\Carbon::today()->isoFormat('dddd, D MMMM YYYY') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 d-none d-lg-flex justify-content-end">
                        <div class="position-relative">
                            <div class="position-absolute top-0 end-0 translate-middle-y">
                                <div class="rounded-circle bg-white bg-opacity-10" style="width: 200px; height: 200px;"></div>
                            </div>
                            <div class="position-absolute top-50 end-0 translate-middle-y">
                                <div class="rounded-circle bg-white bg-opacity-10" style="width: 120px; height: 120px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-primary-dark py-3 border-0">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="bg-white bg-opacity-25 rounded-circle p-2">
                            <i class="fas fa-clock text-white"></i>
                        </div>
                    </div>
                    <div class="col">
                        <p class="mb-0 text-white">Jam Server: <span id="serverTime" class="fw-bold"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Attendance Status Card -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-clipboard-check me-2 text-primary"></i>
                    Presensi Hari Ini
                </h5>
                <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                    {{ \Carbon\Carbon::today()->isoFormat('D MMMM YYYY') }}
                </span>
            </div>
            <div class="card-body">
                @if(!$absensiHariIni || (!$absensiHariIni->jam_masuk && !$absensiHariIni->jam_pulang))
                    <div class="text-center py-4">
                        <div class="mb-3">
                            <div class="d-inline-block rounded-circle bg-light p-3 mb-3">
                                <i class="fas fa-user-clock fa-3x text-primary"></i>
                            </div>
                            <h5 class="fw-bold">Belum Presensi</h5>
                            <p class="text-muted mb-4">Silahkan lakukan presensi masuk untuk hari ini</p>
                        </div>
                        <form action="{{ route('karyawan.presensi.masuk') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-lg px-4 py-2">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                Presensi Masuk
                            </button>
                        </form>
                    </div>
                @elseif($absensiHariIni->jam_masuk && !$absensiHariIni->jam_pulang)
                    <div class="text-center py-4">
                        <div class="mb-3">
                            <div class="d-inline-block rounded-circle bg-success bg-opacity-10 p-3 mb-3">
                                <i class="fas fa-check-circle fa-3x text-success"></i>
                            </div>
                            <h5 class="fw-bold">Presensi Masuk Tercatat</h5>
                            <div class="d-flex justify-content-center align-items-center mb-4">
                                <div class="bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">
                                    <i class="fas fa-clock me-2"></i>
                                    {{ $absensiHariIni->jam_masuk }}
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('karyawan.presensi.pulang') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-lg px-4 py-2">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Presensi Pulang
                            </button>
                        </form>
                    </div>
                @elseif($absensiHariIni->jam_masuk && $absensiHariIni->jam_pulang)
                    <div class="text-center py-4">
                        <div class="mb-3">
                            <div class="d-inline-block rounded-circle bg-primary bg-opacity-10 p-3 mb-3">
                                <i class="fas fa-calendar-check fa-3x text-primary"></i>
                            </div>
                            <h5 class="fw-bold">Presensi Hari Ini Selesai</h5>
                            <p class="text-muted mb-3">Terima kasih atas kerja keras Anda hari ini!</p>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <div class="card border-0 bg-light mb-0">
                                    <div class="card-body p-3 text-center">
                                        <p class="small text-muted mb-1">Jam Masuk</p>
                                        <h5 class="mb-0 fw-bold text-success">{{ $absensiHariIni->jam_masuk }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto d-flex align-items-center px-0">
                                <i class="fas fa-arrow-right text-muted"></i>
                            </div>
                            <div class="col-auto">
                                <div class="card border-0 bg-light mb-0">
                                    <div class="card-body p-3 text-center">
                                        <p class="small text-muted mb-1">Jam Pulang</p>
                                        <h5 class="mb-0 fw-bold text-danger">{{ $absensiHariIni->jam_pulang }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-4">
                        <div class="mb-3">
                            <div class="d-inline-block rounded-circle bg-warning bg-opacity-10 p-3 mb-3">
                                <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                            </div>
                            <h5 class="fw-bold">Status Khusus</h5>
                            <div class="d-flex justify-content-center align-items-center mb-2">
                                <span class="badge bg-{{ $absensiHariIni->status == 'izin' ? 'info' : ($absensiHariIni->status == 'sakit' ? 'warning' : 'danger') }} px-3 py-2">
                                    {{ ucfirst($absensiHariIni->status) }}
                                </span>
                            </div>
                            <p class="text-muted">Keterangan: {{ $absensiHariIni->keterangan ?? 'Tidak ada keterangan' }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Attendance Summary Card -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-chart-pie me-2 text-primary"></i>
                    Ringkasan Kehadiran
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-6 col-md-3">
                        <div class="card border-0 bg-success bg-opacity-10 h-100">
                            <div class="card-body p-3 text-center">
                                <div class="mb-2">
                                    <i class="fas fa-user-check text-success fa-2x"></i>
                                </div>
                                <h3 class="fw-bold text-success mb-0">{{ $statistik['hadir'] ?? 0 }}</h3>
                                <p class="small text-muted mb-0">Hadir</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 bg-info bg-opacity-10 h-100">
                            <div class="card-body p-3 text-center">
                                <div class="mb-2">
                                    <i class="fas fa-file-medical text-info fa-2x"></i>
                                </div>
                                <h3 class="fw-bold text-info mb-0">{{ $statistik['izin'] ?? 0 }}</h3>
                                <p class="small text-muted mb-0">Izin</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 bg-warning bg-opacity-10 h-100">
                            <div class="card-body p-3 text-center">
                                <div class="mb-2">
                                    <i class="fas fa-procedures text-warning fa-2x"></i>
                                </div>
                                <h3 class="fw-bold text-warning mb-0">{{ $statistik['sakit'] ?? 0 }}</h3>
                                <p class="small text-muted mb-0">Sakit</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="card border-0 bg-danger bg-opacity-10 h-100">
                            <div class="card-body p-3 text-center">
                                <div class="mb-2">
                                    <i class="fas fa-user-times text-danger fa-2x"></i>
                                </div>
                                <h3 class="fw-bold text-danger mb-0">{{ $statistik['alpha'] ?? 0 }}</h3>
                                <p class="small text-muted mb-0">Alpha</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-muted small">Tingkat Kehadiran Bulan Ini</span>
                        <span class="badge bg-success px-2 py-1">{{ $statistik['persentase'] ?? '0' }}%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $statistik['persentase'] ?? '0' }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Attendance History Card -->
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-history me-2 text-primary"></i>
                    Riwayat Absensi
                </h5>
                <div>
                    <button class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <button class="btn btn-sm btn-outline-secondary ms-2">
                        <i class="fas fa-download me-1"></i> Ekspor
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3 ps-4">Tanggal</th>
                                <th class="py-3">Jam Masuk</th>
                                <th class="py-3">Jam Pulang</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Keterangan</th>
                                <th class="py-3 text-end pe-4">Durasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayatAbsensi as $absensi)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                <i class="fas fa-calendar-day text-primary"></i>
                                            </div>
                                            <span>{{ $absensi->tanggal->isoFormat('D MMMM YYYY') }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($absensi->jam_masuk)
                                            <span class="text-success">
                                                <i class="fas fa-sign-in-alt me-1"></i>
                                                {{ $absensi->jam_masuk }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($absensi->jam_pulang)
                                            <span class="text-danger">
                                                <i class="fas fa-sign-out-alt me-1"></i>
                                                {{ $absensi->jam_pulang }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $absensi->status == 'hadir' ? 'success' : ($absensi->status == 'izin' ? 'info' : ($absensi->status == 'sakit' ? 'warning' : 'danger')) }} rounded-pill px-3 py-2">
                                            {{ ucfirst($absensi->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($absensi->keterangan)
                                            <span data-bs-toggle="tooltip" title="{{ $absensi->keterangan }}">
                                                {{ \Illuminate\Support\Str::limit($absensi->keterangan, 30) }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        @if($absensi->jam_masuk && $absensi->jam_pulang)
                                            <span class="badge bg-light text-dark px-2 py-1">
                                                {{ $absensi->durasi ?? '8 jam' }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="py-3">
                                            <i class="fas fa-folder-open text-muted fa-3x mb-3"></i>
                                            <p class="mb-0 text-muted">Belum ada riwayat absensi.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white py-3 d-flex justify-content-between align-items-center">
                <span class="text-muted small">Menampilkan {{ $riwayatAbsensi->count() }} dari {{ $riwayatAbsensi->total() }} data</span>
                <div>
                    {{ $riwayatAbsensi->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Server time display
    function updateServerTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('serverTime').textContent = `${hours}:${minutes}:${seconds}`;
    }
    
    // Update time every second
    updateServerTime();
    setInterval(updateServerTime, 1000);
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
</script>
@endsection
