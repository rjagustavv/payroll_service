@extends('layouts.app')

@section('title', 'Hitung Gaji Bulanan')

@section('content')
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                            <i class="fas fa-money-bill-wave text-primary fs-4"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">Hitung Gaji Bulanan</h4>
                            <p class="text-muted mb-0">Periode: {{ $listBulan[$bulan] ?? '' }} {{ $tahun ?? '' }}</p>
                        </div>
                        <div class="ms-auto">
                            <button class="btn btn-outline-primary me-2" onclick="window.print()">
                                <i class="fas fa-print me-1"></i> Cetak Laporan
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
                            Filter Periode
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.gaji.index') }}" class="row g-3 align-items-end"
                            id="filterForm">
                            <div class="col-md-4">
                                <label for="bulan" class="form-label fw-semibold">Bulan</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-calendar-alt text-primary"></i>
                                    </span>
                                    <select name="bulan" id="bulan" class="form-select border-start-0">
                                        @foreach($listBulan as $num => $namaBulan)
                                            <option value="{{ $num }}" {{ $bulan == $num ? 'selected' : '' }}>{{ $namaBulan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="tahun" class="form-label fw-semibold">Tahun</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fas fa-calendar-day text-primary"></i>
                                    </span>
                                    <select name="tahun" id="tahun" class="form-select border-start-0">
                                        @foreach($listTahun as $thn)
                                            <option value="{{ $thn }}" {{ $tahun == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-1"></i> Tampilkan Gaji
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
                <div class="card border-0 shadow-sm bg-primary bg-opacity-10 mb-3">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary p-3 me-3">
                                <i class="fas fa-users text-white"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Total Karyawan</h6>
                                <h4 class="mb-0">{{ count($dataGaji) }}</h4>
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
                                <i class="fas fa-check-circle text-white"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Sudah Diproses</h6>
                                <h4 class="mb-0">{{ collect($dataGaji)->where('sudah_diproses', true)->count() }}</h4>
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
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Belum Diproses</h6>
                                <h4 class="mb-0">{{ collect($dataGaji)->where('sudah_diproses', false)->count() }}</h4>
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
                                <i class="fas fa-money-bill-alt text-white"></i>
                            </div>
                            <div>
                                <h6 class="text-muted mb-1">Total Gaji</h6>
                                <h4 class="mb-0">Rp {{ number_format(collect($dataGaji)->sum('gaji_bersih'), 0, ',', '.') }}
                                </h4>
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
                            <i class="fas fa-table me-2 text-primary"></i>
                            Data Gaji Karyawan
                        </h5>
                        <div class="input-group" style="width: 250px;">
                            <input type="text" class="form-control" placeholder="Cari..." id="searchInput">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-search"></i>
                            </span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <form method="POST" action="{{ route('admin.gaji.proses') }}">
                            @csrf
                            <input type="hidden" name="bulan" value="{{ $bulan }}">
                            <input type="hidden" name="tahun" value="{{ $tahun }}">

                            <div class="table-responsive">
                                <table class="table table-hover align-middle" id="gajiTable">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="px-3 py-3">NIK</th>
                                            <th class="px-3 py-3">Nama Karyawan</th>
                                            <th class="px-3 py-3">Gaji Pokok</th>
                                            <th class="px-3 py-3">Total Hadir</th>
                                            <th class="px-3 py-3">Tanpa Ket.</th>
                                            <th class="px-3 py-3">Potongan</th>
                                            <th class="px-3 py-3">Gaji Bersih</th>
                                            <th class="px-3 py-3">Status</th>
                                            <th class="px-3 py-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($dataGaji as $idx => $item)
                                            <tr>
                                                <td class="px-3 py-3">{{ $item['karyawan']->nik }}</td>
                                                <td class="px-3 py-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-primary text-white rounded-circle p-2 me-2"
                                                            style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                                            {{ substr($item['karyawan']->user->name, 0, 1) }}
                                                        </div>
                                                        <span>{{ $item['karyawan']->user->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="px-3 py-3">
                                                    <span class="badge bg-light text-dark">
                                                        Rp {{ number_format($item['gaji_pokok'], 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="px-3 py-3">
                                                    <span class="badge bg-success">{{ $item['total_hadir'] }} hari</span>
                                                </td>
                                                <td class="px-3 py-3">
                                                    @if($item['total_tanpa_keterangan'] > 0)
                                                        <span class="badge bg-danger">{{ $item['total_tanpa_keterangan'] }}
                                                            hari</span>
                                                    @else
                                                        <span class="badge bg-light text-dark">0 hari</span>
                                                    @endif
                                                </td>
                                                <td class="px-3 py-3">
                                                    <span class="badge bg-warning text-dark">
                                                        Rp {{ number_format($item['potongan'], 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="px-3 py-3">
                                                    <span class="fw-bold text-success">
                                                        Rp {{ number_format($item['gaji_bersih'], 0, ',', '.') }}
                                                    </span>
                                                </td>
                                                <td class="px-3 py-3">
                                                    @if($item['sudah_diproses'])
                                                        <span class="badge bg-success">
                                                            <i class="fas fa-check-circle me-1"></i> Sudah Diproses
                                                        </span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">
                                                            <i class="fas fa-clock me-1"></i> Belum Diproses
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-3 py-3">
                                                    @if($item['sudah_diproses'] && $item['gaji_id'])
                                                        <a href="{{ route('admin.gaji.slip', $item['gaji_id']) }}"
                                                            class="btn btn-sm btn-primary" target="_blank">
                                                            <i class="fas fa-file-invoice me-1"></i> Cetak Slip
                                                        </a>
                                                    @else
                                                        <input type="hidden" name="gaji_data[{{$idx}}][karyawan_id]"
                                                            value="{{ $item['karyawan']->id }}">
                                                        <span class="badge bg-secondary">Belum Tersedia</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-5">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <i class="fas fa-folder-open text-muted mb-3"
                                                            style="font-size: 3rem;"></i>
                                                        <h5 class="text-muted">Tidak ada data gaji</h5>
                                                        <p class="text-muted">Pilih bulan dan tahun, lalu klik "Tampilkan Gaji".
                                                            Atau tidak ada karyawan.</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if(count($dataGaji) > 0 && collect($dataGaji)->where('sudah_diproses', false)->count() > 0)
                                <div class="card-footer bg-white py-3">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save me-1"></i> Proses & Simpan Gaji yang Belum Diproses
                                    </button>
                                    <span class="text-muted ms-2">
                                        <i class="fas fa-info-circle me-1"></i>
                                        {{ collect($dataGaji)->where('sudah_diproses', false)->count() }} data gaji akan
                                        diproses
                                    </span>
                                </div>
                            @elseif(count($dataGaji) > 0 && collect($dataGaji)->where('sudah_diproses', false)->count() == 0)
                                <div class="card-footer bg-white py-3">
                                    <div class="alert alert-success mb-0">
                                        <i class="fas fa-check-circle me-2"></i>
                                        Semua gaji untuk periode ini sudah diproses.
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Simple search functionality
            document.getElementById('searchInput').addEventListener('keyup', function () {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById('searchInput');
                filter = input.value.toUpperCase();
                table = document.getElementById('gajiTable');
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