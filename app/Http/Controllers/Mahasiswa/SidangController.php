<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use App\Models\Sidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SidangController extends Controller
{
    public function index()
    {
        // Ambil data magang milik mahasiswa yang login
        $magang = Magang::where('user_id', Auth::id())->first();
        // Ambil status pendaftaran sidang jika sudah ada
        $sidang = Sidang::where('magang_id', $magang->id ?? 0)->first();

        return view('mahasiswa.sidang.index', compact('magang', 'sidang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_laporan' => 'required|string|max:255',
            'file_laporan' => 'required|mimes:pdf|max:2048',
            'file_nilai_industri' => 'required|mimes:pdf,jpg,png|max:2048',
        ]);

        // Proses Simpan File
        $fileLaporan = $request->file('file_laporan')->store('sidang/laporan', 'public');
        $fileNilai = $request->file('file_nilai_industri')->store('sidang/nilai', 'public');

        Sidang::create([
            'magang_id' => $request->magang_id,
            'judul_laporan' => $request->judul_laporan,
            'file_laporan' => $fileLaporan,
            'file_nilai_industri' => $fileNilai,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Berhasil mengajukan sidang! Mohon tunggu verifikasi Admin.');
    }
    
}