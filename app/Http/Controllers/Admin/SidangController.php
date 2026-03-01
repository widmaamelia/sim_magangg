<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sidang; // Pastikan Model Sidang di-import
use Illuminate\Http\Request;

class SidangController extends Controller
{
    public function index()
    {
        $sidangs = Sidang::with('magang.mahasiswa')->latest()->get();
        return view('admin.sidang.index', compact('sidangs'));
    }

    // --- TAMBAHKAN FUNGSI EDIT INI UNTUK MENGHILANGKAN ERROR ---
    public function edit($id)
    {
        // 1. Cari data sidang berdasarkan ID yang diklik
        $sidang = Sidang::with('magang.mahasiswa')->findOrFail($id);
        
        // 2. Tampilkan ke halaman kartu (card) edit
        return view('admin.sidang.edit', compact('sidang'));
    }

    // --- TAMBAHKAN JUGA FUNGSI UPDATE UNTUK MENYIMPAN DATA ---
    public function update(Request $request, $id)
    {
        $request->validate([
        'jadwal_sidang' => 'required|date',
        'lokasi_sidang' => 'required|string',
    ]);

    $sidang = Sidang::findOrFail($id);
    
    // UPDATE STATUS JUGA DI SINI!
    $sidang->update([
        'jadwal_sidang' => $request->jadwal_sidang,
        'lokasi_sidang' => $request->lokasi_sidang,
        'status'        => 'disetujui', // Ini yang bikin status di mahasiswa berubah jadi hijau
    ]);

    return redirect()->route('admin.sidang.index')
        ->with('success', 'Amelia, jadwal sidang mahasiswa berhasil disetujui!');
    }
}