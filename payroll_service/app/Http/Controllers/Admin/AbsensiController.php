<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function rekap(Request $request)
    {
        $karyawans = Karyawan::with('user')->orderBy('user_id')->get(); // Ambil semua karyawan untuk filter
        
        $filterKaryawanId = $request->input('karyawan_id');
        $filterBulan = $request->input('bulan', Carbon::now()->month);
        $filterTahun = $request->input('tahun', Carbon::now()->year);

        $absensiQuery = Absensi::with('karyawan.user')
            ->whereYear('tanggal', $filterTahun)
            ->whereMonth('tanggal', $filterBulan)
            ->orderBy('tanggal', 'asc');

        if ($filterKaryawanId) {
            $absensiQuery->where('karyawan_id', $filterKaryawanId);
        }

        $rekapAbsensi = $absensiQuery->get();
        
        // Untuk dropdown filter
        $listBulan = [];
        for ($m = 1; $m <= 12; $m++) {
            $listBulan[$m] = Carbon::create()->month($m)->isoFormat('MMMM');
        }
        $listTahun = range(Carbon::now()->year, Carbon::now()->year - 5);


        return view('admin.absensi.rekap', compact('rekapAbsensi', 'karyawans', 'filterKaryawanId', 'filterBulan', 'filterTahun', 'listBulan', 'listTahun'));
    }

    // Opsional: Tambah, Edit, Hapus absensi oleh Admin
    // public function create() { ... }
    // public function store(Request $request) { ... }
    // public function edit(Absensi $absensi) { ... }
    // public function update(Request $request, Absensi $absensi) { ... }
    // public function destroy(Absensi $absensi) { ... }
}