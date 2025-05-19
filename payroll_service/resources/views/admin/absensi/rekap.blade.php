@extends('layouts.app')

@section('title', 'Rekap Absensi Karyawan')

@section('content')
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                            <i class="fas fa-calendar-check text-primary fs-4"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">Rekap Absensi Karyawan</h4>
                            <p class="text-muted mb-0">Laporan kehadiran karyawan periode
                                {{ $listBulan[$filterBulan] ?? '' }} {{ $filterTahun ?? '' }}</p>
                        </div>
                        <div class="ms-auto">
                            <button class="btn btn-outline-primary me-2" onclick="window.print()">
                                <i class="fas fa-print me-1"></i> Cetak
                            </button>
                            <button class="btn btn-outline-success">
                                <i class="fas fa-file-excel me-1"></i> Export Excel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-filter me-2 text-primary"></i>
                            Filter Data
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.absensi.rekap') }}" class="row g-3">
                            <div class="col-md-4">
                                <label for="karyawan_id" class="form-label fw-semibold">Karyawan</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-user text-primary"></i>
                                    </span>
                                    <select name="karyawan_id" id="karyawan_id" class="form-select">
                                        <option value="">Semua Karyawan</option>
                                        @foreach($karyawans as $k)
                                            <option value="{{ $k->id }}" {{ $filterKaryawanId == $k->id ? 'selected' : '' }}>
                                                {{ $k->nik }} - {{ $k->user->name ?? 'N/A' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="bulan" class="form-label fw-semibold">Bulan</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-calendar-alt text-primary"></i>
                                    </span>
                                    <select name="bulan" id="bulan" class="form-select">
                                        @foreach($listBulan as $num => $namaBulan)
                                            <option value="{{ $num }}" {{ $filterBulan == $num ? 'selected' : '' }}>
                                                {{ $namaBulan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="tahun" class="form-label fw-semibold">Tahun</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-calendar-day text-primary"></i>
                                    </span>
                                    <select name="tahun" id="tahun" class="form-select">
                                        @foreach($listTahun as $thn)
                                            <option value="{{ $thn }}" {{ $filterTahun == $thn ? 'selected' : '' }}>{{ $thn }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label d-none d-md-block">&nbsp;</label>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-1"></i> Tampilkan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-success bg-opacity-10 mb-3">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-success p-3 me-3">
                                <i class="fas fa-user-check text-white"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Hadir</h6>
                                <h4 class="mb-0">{{ $rekapAbsensi->where('status', 'hadir')->count() }}</h4>
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
                                <i class="fas fa-user-clock text-white"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Izin</h6>
                                <h4 class="mb-0">{{ $rekapAbsensi->where('status', 'izin')->count() }}</h4>
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
                                <i class="fas fa-procedures text-white"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Sakit</h6>
                                <h4 class="mb-0">{{ $rekapAbsensi->where('status', 'sakit')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm bg-danger bg-opacity-10 mb-3">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-danger p-3 me-3">
                                <i class="fas fa-user-times text-white"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Tidak Hadir</h6>
                                <h4 class="mb-0">{{ $rekapAbsensi->where('status', 'alpha')->count() }}</h4>
                            </div>
                        </div>
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
                            <i class="fas fa-list me-2 text-primary"></i>
                            Data Absensi
                        </h5>
                        <div class="input-group" style="width: 250px;">
                            <input type="text" class="form-control" placeholder="Cari..." id="searchInput">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="absensiTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="px-3 py-3" style="width: 60px;">No.</th>
                                        <th class="px-3 py-3">Nama Karyawan</th>
                                        <th class="px-3 py-3">NIK</th>
                                        <th class="px-3 py-3">Tanggal</th>
                                        <th class="px-3 py-3">Jam Masuk</th>
                                        <th class="px-3 py-3">Jam Pulang</th>
                                        <th class="px-3 py-3">Status</th>
                                        <th class="px-3 py-3">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rekapAbsensi as $index => $absensi)
                                        <tr>
                                            <td class="px-3 py-3">{{ $index + 1 }}</td>
                                            <td class="px-3 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary text-white rounded-circle p-2 me-2"
                                                        style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                                        {{ substr($absensi->karyawan->user->name ?? 'N/A', 0, 1) }}
                                                    </div>
                                                    <span>{{ $absensi->karyawan->user->name ?? 'N/A' }}</span>
                                                </div>
                                            </td>
                                            <td class="px-3 py-3">{{ $absensi->karyawan->nik ?? 'N/A' }}</td>
                                            <td class="px-3 py-3">{{ $absensi->tanggal->isoFormat('dddd, D MMMM YYYY') }}</td>
                                            <td class="px-3 py-3">
                                                @if($absensi->jam_masuk)
                                                    <span class="badge bg-light text-dark">
                                                        <i class="fas fa-clock me-1 text-success"></i>
                                                        {{ $absensi->jam_masuk }}
                                                    </span>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </td>
                                            <td class="px-3 py-3">
                                                @if($absensi->jam_pulang)
                                                    <span class="badge bg-light text-dark">
                                                        <i class="fas fa-clock me-1 text-danger"></i>
                                                        {{ $absensi->jam_pulang }}
                                                    </span>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </td>
                                            <td class="px-3 py-3">
                                                @if($absensi->status == 'hadir')
                                                    <span class="badge bg-success">Hadir</span>
                                                @elseif($absensi->status == 'izin')
                                                    <span class="badge bg-warning text-dark">Izin</span>
                                                @elseif($absensi->status == 'sakit')
                                                    <span class="badge bg-info text-dark">Sakit</span>
                                                @else
                                                    <span class="badge bg-danger">Alpha</span>
                                                @endif
                                            </td>
                                            <td class="px-3 py-3">
                                                @if($absensi->keterangan)
                                                    <button type="button" class="btn btn-sm btn-light" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="{{ $absensi->keterangan }}">
                                                        <i class="fas fa-info-circle text-primary"></i> Lihat
                                                    </button>
                                                @else
                                                    <span>-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="fas fa-folder-open text-muted mb-3" style="font-size: 3rem;"></i>
                                                    <h5 class="text-muted">Tidak ada data absensi</h5>
                                                    <p class="text-muted">Tidak ada data absensi untuk filter yang dipilih.</p>
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
                                <span class="text-muted">Menampilkan {{ $rekapAbsensi->count() }} data</span>
                            </div>
                            <nav aria-label="Page navigation">
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
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
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });

            // Simple search functionality
            document.getElementById('searchInput').addEventListener('keyup', function () {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById('searchInput');
                filter = input.value.toUpperCase();
                table = document.getElementById('absensiTable');
                tr = table.getElementsByTagName('tr');

                for (i = 1; i < tr.length; i++) {
                    var found = false;
                    var tds = tr[i].getElementsByTagName('td');

                    for (var j = 0; j < tds.length; j++) {
                        td = tds[j];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                found = true;
                                break;
                            }
                        }
                    }

                    if (found) {
                        tr[i].style.display = '';
                    } else {
                        tr[i].style.display = 'none';
                    }
                }
            });
        });
    </script>
@endsection