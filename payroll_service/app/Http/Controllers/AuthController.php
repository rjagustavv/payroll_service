<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Tambahkan ini
use Illuminate\Support\Facades\DB;    // Tambahkan ini
use App\Models\User;
use App\Models\Karyawan; // Tambahkan ini
use Illuminate\Validation\Rules\Password; // Untuk aturan password yang lebih kuat

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->isKaryawan()) {
                return redirect()->route('karyawan.dashboard');
            }
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($user->isKaryawan()) {
                return redirect()->intended(route('karyawan.dashboard'));
            }
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // --- Metode Baru untuk Registrasi ---
    public function showRegistrationForm()
    {
        if (Auth::check()) { // Jika sudah login, redirect
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->isKaryawan()) {
                return redirect()->route('karyawan.dashboard');
            }
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)], // 'password_confirmation' field is needed in form
            'nik' => 'required|string|max:20|unique:karyawan',
            'posisi' => 'required|string|max:100',
            'tanggal_masuk' => 'required|date',
            'gaji_pokok' => 'required|numeric|min:0',
            'no_telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'karyawan', // Default role untuk registrasi
            ]);

            $user->karyawan()->create([
                'nik' => $request->nik,
                'posisi' => $request->posisi,
                'tanggal_masuk' => $request->tanggal_masuk,
                'gaji_pokok' => $request->gaji_pokok,
                'no_telepon' => $request->no_telepon,
                'alamat' => $request->alamat,
            ]);

            DB::commit();

            // Otomatis login setelah registrasi
            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('karyawan.dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Log::error($e->getMessage()); // Sebaiknya di-log
            return back()->withInput()->with('error', 'Registrasi gagal: ' . $e->getMessage());
        }
    }
    // --- Akhir Metode Baru ---
}