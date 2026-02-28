<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Menampilkan halaman form registrasi.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Proses pendaftaran mahasiswa baru.
     */
    public function register(Request $request)
    {
        // 1. Validasi Input
        // Pastikan 'kelas' divalidasi agar tidak lolos data kosong
        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|string|email|max:255|unique:users',
            'identity_number' => 'required|string|unique:users', // NIM
            'kelas'           => 'required|string',             // ✅ Kelas dari Dropdown
            'password'        => 'required|string|min:8|confirmed',
        ]);

        // 2. Simpan ke Database
        // Menambahkan 'kelas' ke dalam proses pembuatan user agar tidak NULL
        $user = User::create([
            'name'            => $request->name,
            'email'           => $request->email,
            'identity_number' => $request->identity_number,
            'kelas'           => $request->kelas, // ✅ Pastikan ini terpanggil
            'password'        => Hash::make($request->password),
            'role'            => 'mahasiswa', // Default pendaftar
        ]);

        // 3. Otomatis Login setelah berhasil mendaftar
        Auth::login($user);

        // 4. Redirect ke Dashboard Mahasiswa
        return redirect('/mahasiswa/dashboard')->with('success', 'Registrasi berhasil, selamat datang!');
    }
}