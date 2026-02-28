<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use App\Models\User;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
     /**
     * Tampilkan semua pengajuan magang (ADMIN)
     */
    public function index(Request $request)
    {
       //Mulai query dengan relasi mahasiswa dan dosen
    $query = Magang::with(['mahasiswa', 'dosen']);
    // 1. Ambil semua data pengajuan magang
        $pengajuans = Magang::with('mahasiswa')->latest()->get();

        // 2. AMBIL DATA DOSEN (Ini yang kurang!)
        // Kita ambil user yang rolenya adalah 'dosen'
        $dosens = User::where('role', 'dosen')->get();

    // Cek jika ada request filter kelas
    if ($request->has('kelas') && $request->kelas != '') {
        $query->whereHas('mahasiswa', function($q) use ($request) {
            $q->where('kelas', $request->kelas);
        });
    }

    $pengajuans = $query->latest()->get();

    return view('admin.pengajuan.index', compact('pengajuans'));
    }

    /**
     * Detail pengajuan magang
     */
    public function show($id)
    {
        $pengajuan = Magang::with(['mahasiswa', 'dosen'])
            ->findOrFail($id);

        // ambil dosen untuk dropdown pembimbing
        $dosens = User::where('role', 'dosen')->get();

        return view('admin.pengajuan.show', compact('pengajuan', 'dosens'));
    }

    /**
     * Terima pengajuan
     */
    public function terima($id)
    {
        $pengajuan = Magang::findOrFail($id);

    $pengajuan->update([
        // GUNAKAN 'disetujui' karena database menolak 'diterima'
        'status' => 'disetujui', 
    ]);

    return redirect()->route('admin.pengajuan.index')
        ->with('success', 'Pengajuan berhasil disetujui!');
    }

    /**
     * Tolak pengajuan
     */
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string',
        ]);

        $pengajuan = Magang::findOrFail($id);

        $pengajuan->update([
            'status' => 'ditolak',
            'alasan_penolakan' => $request->alasan_penolakan,
        ]);

        return redirect()
            ->route('admin.pengajuan.index')
            ->with('success', 'Pengajuan berhasil ditolak');
    }

    /**
     * Tentukan dosen pembimbing
     */
    public function tentukanPembimbing(Request $request, $id)
    {
        // 1. Validasi input agar dosen_id tidak kosong dan ada di database
    $request->validate([
        'dosen_id' => 'required|exists:users,id'
    ]);

    // 2. Cari data pengajuan berdasarkan ID
    $magang = \App\Models\Magang::findOrFail($id);

    // 3. Update kolom dosen_id sesuai pilihan Amelia
    $magang->update([
        'dosen_id' => $request->dosen_id
    ]);

    // 4. Kembali ke halaman daftar dengan pesan sukses
    return redirect()->route('admin.pengajuan.index')
                     ->with('success', 'Amelia, dosen pembimbing berhasil disimpan!');

    }
}
