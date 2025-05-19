<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $adminUser = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        // Tidak perlu data karyawan untuk admin, kecuali jika admin juga karyawan

        // Karyawan 1
        $karyawanUser1 = User::create([
            'name' => 'Budi Karyawan',
            'email' => 'budi@example.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);
        Karyawan::create([
            'user_id' => $karyawanUser1->id,
            'nik' => 'K001',
            'alamat' => 'Jl. Merdeka No. 10',
            'no_telepon' => '081234567890',
            'posisi' => 'Staff IT',
            'tanggal_masuk' => '2023-01-15',
            'gaji_pokok' => 5000000,
        ]);

        // Karyawan 2
        $karyawanUser2 = User::create([
            'name' => 'Siti Karyawati',
            'email' => 'siti@example.com',
            'password' => Hash::make('password'),
            'role' => 'karyawan',
        ]);
        Karyawan::create([
            'user_id' => $karyawanUser2->id,
            'nik' => 'K002',
            'alamat' => 'Jl. Sudirman No. 25',
            'no_telepon' => '087654321098',
            'posisi' => 'Marketing',
            'tanggal_masuk' => '2022-06-01',
            'gaji_pokok' => 6500000,
        ]);
    }
}