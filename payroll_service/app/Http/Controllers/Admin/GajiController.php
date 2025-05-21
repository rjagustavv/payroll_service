<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GajiController extends Controller
{
    // Misal potongan per hari tidak hadir (tanpa keterangan)
    const POTONGAN_PER_HARI_ALPHA_PERSENTASE = 00.04; // 4% dari gaji pokok per hari alpha (asumsi 25 hari kerja)
                                                // Atau bisa juga nilai tetap, misal 50000

    public function index(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);

        $karyawans = Karyawan::with(['user', 'gaji' => function($q) use ($bulan, $tahun) {
            $q->where('bulan', $bulan)->where('tahun', $tahun);
        }])->get();

        $dataGaji = [];
        foreach ($karyawans as $karyawan) {
            // Cek apakah gaji sudah dihitung dan disimpan
            $gajiExisting = $karyawan->gaji->first();
            if ($gajiExisting) {
                $dataGaji[] = [
                    'karyawan' => $karyawan,
                    'gaji_pokok' => $gajiExisting->gaji_pokok,
                    'total_hadir' => $gajiExisting->total_hadir,
                    'total_izin' => $gajiExisting->total_izin,
                    'total_sakit' => $gajiExisting->total_sakit,
                    'total_tanpa_keterangan' => $gajiExisting->total_tanpa_keterangan,
                    'potongan' => $gajiExisting->potongan,
                    'gaji_bersih' => $gajiExisting->gaji_bersih,
                    'keterangan_gaji' => $gajiExisting->keterangan_gaji,
                    'sudah_diproses' => true,
                    'gaji_id' => $gajiExisting->id,
                ];
            } else {
                // Hitung jika belum ada
                $absensi = Absensi::where('karyawan_id', $karyawan->id)
                                ->whereYear('tanggal', $tahun)
                                ->whereMonth('tanggal', $bulan)
                                ->get();

                $totalHadir = $absensi->where('status', 'hadir')->count();
                $totalIzin = $absensi->where('status', 'izin')->count();
                $totalSakit = $absensi->where('status', 'sakit')->count();
                $totalTanpaKeterangan = $absensi->where('status', 'tanpa keterangan')->count();
                
                // Perhitungan potongan: (jumlah hari 'tanpa keterangan') * (nilai potongan per hari)
                // Nilai potongan per hari bisa: gaji_pokok / jumlah_hari_kerja_bulan_itu (misal 22 atau 25)
                // Atau, bisa juga persentase gaji pokok seperti di constant.
                // Untuk simple: gaji_pokok / 25 hari kerja
                $potonganPerHari = $karyawan->gaji_pokok / 25; // Asumsi 25 hari kerja
                $potongan = $totalTanpaKeterangan * $potonganPerHari;
                
                // Atau jika pakai persentase
                $potongan = $totalTanpaKeterangan * ($karyawan->gaji_pokok * self::POTONGAN_PER_HARI_ALPHA_PERSENTASE);


                $gajiBersih = $karyawan->gaji_pokok - $potongan;

                $dataGaji[] = [
                    'karyawan' => $karyawan,
                    'gaji_pokok' => $karyawan->gaji_pokok,
                    'total_hadir' => $totalHadir,
                    'total_izin' => $totalIzin,
                    'total_sakit' => $totalSakit,
                    'total_tanpa_keterangan' => $totalTanpaKeterangan,
                    'potongan' => $potongan,
                    'gaji_bersih' => $gajiBersih,
                    'keterangan_gaji' => $totalTanpaKeterangan > 0 ? $totalTanpaKeterangan . ' hari tanpa keterangan.' : 'Tidak ada potongan.',
                    'sudah_diproses' => false,
                    'gaji_id' => null,
                ];
            }
        }
        
        $listBulan = [];
        for ($m = 1; $m <= 12; $m++) {
            $listBulan[$m] = Carbon::create()->month($m)->isoFormat('MMMM');
        }
        $listTahun = range(Carbon::now()->year, Carbon::now()->year - 5);

        return view('admin.gaji.index', compact('dataGaji', 'bulan', 'tahun', 'listBulan', 'listTahun'));
    }

    public function prosesGaji(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000|max:' . (Carbon::now()->year + 1),
            'gaji_data' => 'required|array',
            'gaji_data.*.karyawan_id' => 'required|exists:karyawan,id',
            // Tambahkan validasi lain jika perlu
        ]);
    
        DB::beginTransaction();
        try {
            foreach ($request->gaji_data as $data) {
                // Cek apakah gaji untuk karyawan ini, bulan, dan tahun ini sudah ada
                $existingGaji = Gaji::where('karyawan_id', $data['karyawan_id'])
                                    ->where('bulan', $request->bulan)
                                    ->where('tahun', $request->tahun)
                                    ->first();
    
                if (!$existingGaji) { // Hanya proses jika belum ada
                    $karyawan = Karyawan::find($data['karyawan_id']);
                    if (!$karyawan) continue; // Skip jika karyawan tidak ditemukan
    
                    $absensi = Absensi::where('karyawan_id', $karyawan->id)
                                    ->whereYear('tanggal', $request->tahun)
                                    ->whereMonth('tanggal', $request->bulan)
                                    ->get();
    
                    $totalHadir = $absensi->where('status', 'hadir')->count();
                    $totalIzin = $absensi->where('status', 'izin')->count();
                    $totalSakit = $absensi->where('status', 'sakit')->count();
                    $totalTanpaKeterangan = $absensi->where('status', 'tanpa keterangan')->count();
    
                    $potonganPerHari = $karyawan->gaji_pokok / 25; // Asumsi 25 hari kerja
                    $potongan = $totalTanpaKeterangan * $potonganPerHari;
                    $gajiBersih = $karyawan->gaji_pokok - $potongan;
    
                    Gaji::create([
                        'karyawan_id' => $karyawan->id,
                        'bulan' => $request->bulan,
                        'tahun' => $request->tahun,
                        'total_hadir' => $totalHadir,
                        'total_izin' => $totalIzin,
                        'total_sakit' => $totalSakit,
                        'total_tanpa_keterangan' => $totalTanpaKeterangan,
                        'gaji_pokok' => $karyawan->gaji_pokok,
                        'potongan' => $potongan,
                        'gaji_bersih' => $gajiBersih,
                        'keterangan_gaji' => $totalTanpaKeterangan > 0 ? $totalTanpaKeterangan . ' hari tanpa keterangan.' : 'Tidak ada potongan.',
                        'tanggal_pembayaran' => Carbon::now(), // Atau tanggal spesifik
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.gaji.index', ['bulan' => $request->bulan, 'tahun' => $request->tahun])
                             ->with('success', 'Gaji berhasil diproses dan disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses gaji: ' . $e->getMessage());
        }
    }


    public function cetakSlip($gaji_id) // ID Gaji dari tabel gaji
    {
        $gaji = Gaji::with('karyawan.user')->findOrFail($gaji_id);
        return view('admin.gaji.slip', compact('gaji'));
    }
}