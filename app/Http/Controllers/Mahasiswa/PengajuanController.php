<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuan = Magang::where('user_id', Auth::id())->get();
        return view('mahasiswa.pengajuan.index', compact('pengajuan'));
    }
    public function create()
    {
        // Menampilkan halaman form pengajuan
        return view('mahasiswa.pengajuan.create');
    }

    // --- PASTIKAN FUNGSI STORE INI ADA DI DALAM CLASS ---
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'nama_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        // 2. Simpan ke Database
        Magang::create([
            'user_id' => Auth::id(),
            'nama_perusahaan' => $request->nama_perusahaan,
            'alamat_perusahaan' => $request->alamat_perusahaan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'pending', // Status awal selalu pending
        ]);

        // 3. Kembali dengan pesan sukses
        return redirect()->route('mahasiswa.pengajuan.index')
                     ->with('success', 'Amelia, pengajuan magang kamu berhasil dikirim!');
    }
    
}
