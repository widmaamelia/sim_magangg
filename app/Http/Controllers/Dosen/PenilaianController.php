<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use App\Models\Nilai;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    public function index()
    {
        $results = Nilai::with('magang.mahasiswa')
                ->where('dosen_id', Auth::id()) 
                ->get();

    return view('dosen.penilaian.index', compact('results'));
    }
    public function create(Request $request)
    {
        // Mengambil ID magang dari parameter URL
        $magangId = $request->query('id') ?? $request->id; 
        
        // Cari data magang beserta mahasiswanya agar nama mahasiswa tampil di form
        $magang = Magang::with('mahasiswa')->findOrFail($magangId);

        return view('dosen.penilaian.create', compact('magang'));
    }
    // --- TAMBAHKAN FUNGSI STORE INI ---
    public function store(Request $request)
    {
        // 1. Validasi
    $request->validate([
        'magang_id' => 'required|exists:magangs,id',
        'nilai' => 'required|numeric|min:0|max:100', // Nama input di form adalah 'nilai'
        'keterangan' => 'nullable|string'
    ]);

    // 2. Simpan ke tabel nilais (Arsip)
    Nilai::create([
        'magang_id'   => $request->magang_id,
        'dosen_id'    => Auth::id(), 
        'angka_nilai' => $request->nilai, 
        'keterangan'  => $request->keterangan,
    ]);

    // 3. UPDATE tabel magangs (Agar status di Monitoring berubah!)
    $magang = Magang::findOrFail($request->magang_id);
    $magang->update([
        'angka_nilai' => $request->nilai, // Gunakan $request->nilai sesuai validasi
    ]);

    return redirect()
        ->route('dosen.monitoring.index') 
        ->with('success', 'Amelia, nilai mahasiswa berhasil disimpan!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'keterangan' => 'nullable|string'
        ]);

        $nilai = Nilai::findOrFail($id);
        
        // Update di tabel riwayat nilai
        $nilai->update([
            'angka_nilai' => $request->nilai,
            'keterangan'  => $request->keterangan
        ]);

        // Update juga di tabel magangs agar tampilan Monitoring tetap sinkron
        Magang::where('id', $nilai->magang_id)->update([
            'angka_nilai' => $request->nilai
        ]);

        return redirect()->route('dosen.penilaian.index')->with('success', 'Amelia, nilai mahasiswa berhasil diperbarui!');
    }

    /**
     * Hapus data nilai mahasiswa.
     */
    public function destroy($id)
    {
        // Mencari data nilai berdasarkan ID dan menghapusnya
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->back()->with('success', 'Amelia, data nilai berhasil dihapus!');
    }
    public function exportPDF($kelas)
    {
        // Ambil data nilai beserta relasi bertingkatnya
    $data = Nilai::with(['magang.mahasiswa'])
        ->whereHas('magang.mahasiswa', function($query) use ($kelas) {
            $query->where('kelas', $kelas);
        })
        ->get();

    // 1. Load file blade yang tadi sudah Amelia buat
    $pdf = Pdf::loadView('dosen.penilaian.export_pdf', compact('data', 'kelas'));

    // 2. Set ukuran kertas (Opsional, misal A4)
    $pdf->setPaper('a4', 'portrait');

    // 3. Download otomatis dengan nama file yang rapi
    return $pdf->download("Laporan_Nilai_Magang_Kelas_{$kelas}.pdf");
    }
}
