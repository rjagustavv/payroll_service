<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; // Untuk transaksi

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $karyawans = Karyawan::with('user')
            ->when($search, function ($query, $search) {
                return $query->where('nik', 'like', "%{$search}%")
                             ->orWhereHas('user', function ($q) use ($search) {
                                 $q->where('name', 'like', "%{$search}%");
                             });
            })
            ->latest()
            ->paginate(10);
        return view('admin.karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        return view('admin.karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nik' => 'required|string|max:20|unique:karyawan',
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:15',
            'posisi' => 'required|string|max:100',
            'tanggal_masuk' => 'required|date',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'karyawan',
            ]);

            $user->karyawan()->create([
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'posisi' => $request->posisi,
                'tanggal_masuk' => $request->tanggal_masuk,
                'gaji_pokok' => $request->gaji_pokok,
            ]);

            DB::commit();
            return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage()); // Sebaiknya di-log
            return back()->withInput()->with('error', 'Gagal menambahkan karyawan: ' . $e->getMessage());
        }
    }

    public function show(Karyawan $karyawan)
    {
        // Biasanya tidak digunakan jika ada edit, tapi bisa untuk detail view
        return view('admin.karyawan.show', compact('karyawan'));
    }

    public function edit(Karyawan $karyawan)
    {
        $karyawan->load('user'); // Eager load user
        return view('admin.karyawan.edit', compact('karyawan'));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $karyawan->user_id,
            'password' => 'nullable|string|min:8|confirmed',
            'nik' => 'required|string|max:20|unique:karyawan,nik,' . $karyawan->id,
            'alamat' => 'nullable|string',
            'no_telepon' => 'nullable|string|max:15',
            'posisi' => 'required|string|max:100',
            'tanggal_masuk' => 'required|date',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $userData = [
                'name' => $request->name,
                'email' => $request->email,
            ];
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }
            $karyawan->user->update($userData);

            $karyawan->update([
                'nik' => $request->nik,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
                'posisi' => $request->posisi,
                'tanggal_masuk' => $request->tanggal_masuk,
                'gaji_pokok' => $request->gaji_pokok,
            ]);
            DB::commit();
            return redirect()->route('admin.karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui karyawan: ' . $e->getMessage());
        }
    }

    public function destroy(Karyawan $karyawan)
    {
        DB::beginTransaction();
        try {
            // Hapus absensi dan gaji terkait dulu jika ada foreign key constraint yang ketat
            // $karyawan->absensi()->delete();
            // $karyawan->gaji()->delete();
            // User akan terhapus otomatis jika onDelete('cascade') pada karyawan->user_id
            // Jika tidak, hapus manual:
            // $karyawan->user()->delete();
            $karyawan->delete(); // Ini akan men-trigger penghapusan user jika cascade diset di migration
            DB::commit();
            return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.karyawan.index')->with('error', 'Gagal menghapus karyawan, mungkin masih ada data terkait.');
        }
    }
}