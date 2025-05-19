<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $karyawan = Auth::user()->karyawan;
        if (!$karyawan) {
            Auth::logout();
            return redirect('/login')->with('error', 'Data karyawan tidak ditemukan.');
        }

        $today = Carbon::today();
        $absensiHariIni = Absensi::where('karyawan_id', $karyawan->id)
                                ->whereDate('tanggal', $today)
                                ->first();

        $riwayatAbsensi = Absensi::where('karyawan_id', $karyawan->id)
                                ->orderBy('tanggal', 'desc')
                                ->paginate(10);

        return view('karyawan.dashboard', compact('absensiHariIni', 'riwayatAbsensi', 'karyawan'));
    }
}