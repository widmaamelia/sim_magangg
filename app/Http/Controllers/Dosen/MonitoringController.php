<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\Magang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringController extends Controller
{
    public function index()
    {
        // Melihat mahasiswa yang dibimbing oleh dosen login
        // $mahasiswas = Magang::where('dosen_id', Auth::id())->with('mahasiswa')->get();
        // return view('dosen.monitoring.index', compact('mahasiswas'));
        $mahasiswas = Magang::where('dosen_id', Auth::id())
        ->with(['mahasiswa', 'nilai', 'logbooks']) // Tambahkan 'nilai' di sini
        ->get();


    return view('dosen.monitoring.index', compact('mahasiswas'));
    }
    public function updateStatus(Request $request, $id)
    {
        $magang = \App\Models\Magang::findOrFail($id);
        $magang->update([
            'status' => $request->status, // 'disetujui' atau 'ditolak'
            'dosen_id' => Auth::id(),   // Dosen yang klik otomatis jadi pembimbing
        ]);

        return back()->with('success', 'Status pengajuan mahasiswa berhasil diperbarui!');
    }
    // --- TAMBAHKAN FUNGSI INI ---
    public function logbook($id)
    {
        // 1. Ambil data magang berdasarkan ID yang diklik
        $magang = Magang::with('mahasiswa')->findOrFail($id);
        
        // 2. Ambil semua catatan logbook milik mahasiswa tersebut
        $logbooks = Logbook::where('magang_id', $id)->latest()->get();

        // 3. Kirim data ke view dosen.monitoring.logbook
        return view('dosen.monitoring.logbook', compact('magang', 'logbooks'));
    }
    // Fungsi untuk Dosen memberikan ACC dan Komentar pada setiap baris logbook
    public function reviewLogbook(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,acc',
            'komentar_dosen' => 'nullable|string'
        ]);

        $logbook = Logbook::findOrFail($id);
        $logbook->update([
            'status' => $request->status,
            'komentar_dosen' => $request->komentar_dosen
        ]);

        return redirect()->back()->with('success', 'Berhasil memberikan review pada logbook mahasiswa!');
    }
}
