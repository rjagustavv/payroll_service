<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function presensiMasuk()
    {
        $karyawan = Auth::user()->karyawan;
        $today = Carbon::today();

        $absensiHariIni = Absensi::where('karyawan_id', $karyawan->id)
                                ->whereDate('tanggal', $today)
                                ->first();

        if ($absensiHariIni && $absensiHariIni->jam_masuk) {
            return redirect()->route('karyawan.dashboard')->with('warning', 'Anda sudah melakukan presensi masuk hari ini.');
        }

        if (!$absensiHariIni) {
             Absensi::create([
                'karyawan_id' => $karyawan->id,
                'tanggal' => $today,
                'jam_masuk' => Carbon::now()->format('H:i:s'),
                'status' => 'hadir',
            ]);
        } else {
            // Jika ada record tapi belum jam masuk (misal dibuat admin sebagai izin/sakit)
            // Ini seharusnya tidak terjadi jika karyawan yang input sendiri, tapi sebagai safeguard
            $absensiHariIni->update([
                'jam_masuk' => Carbon::now()->format('H:i:s'),
                'status' => 'hadir', // pastikan statusnya hadir
            ]);
        }

        return redirect()->route('karyawan.dashboard')->with('success', 'Presensi masuk berhasil.');
    }

    public function presensiPulang()
    {
        $karyawan = Auth::user()->karyawan;
        $today = Carbon::today();

        $absensiHariIni = Absensi::where('karyawan_id', $karyawan->id)
                                ->whereDate('tanggal', $today)
                                ->first();

        if (!$absensiHariIni || !$absensiHariIni->jam_masuk) {
            return redirect()->route('karyawan.dashboard')->with('error', 'Anda belum melakukan presensi masuk hari ini.');
        }

        if ($absensiHariIni->jam_pulang) {
            return redirect()->route('karyawan.dashboard')->with('warning', 'Anda sudah melakukan presensi pulang hari ini.');
        }

        $absensiHariIni->update([
            'jam_pulang' => Carbon::now()->format('H:i:s'),
        ]);

        return redirect()->route('karyawan.dashboard')->with('success', 'Presensi pulang berhasil.');
    }
}