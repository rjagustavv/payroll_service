<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Absensi;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahKaryawan = Karyawan::count();
        $absensiHariIni = Absensi::whereDate('tanggal', today())->count();
        // Tambahkan statistik lain jika perlu
        return view('admin.dashboard', compact('jumlahKaryawan', 'absensiHariIni'));
    }
}