<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\Magang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    public function index()
    {
        // Mengambil logbook berdasarkan data magang mahasiswa yang sedang login
        $magang = Magang::where('user_id', Auth::id())->first();
        $logbooks = $magang ? Logbook::where('magang_id', $magang->id)->get() : [];
        
        return view('mahasiswa.logbook.index', compact('logbooks'));
    }
    public function create()
{
    // Mengarahkan ke file create.blade.php yang baru
    return view('mahasiswa.logbook.create');
}
    // --- TAMBAHKAN FUNGSI INI ---
    public function store(Request $request)
{
   // 1. Validasi Input termasuk file lampiran
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string|min:10',
            'file_lampiran' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // Max 2MB
        ]);

        // 2. Cari data magang yang sudah disetujui
        $magang = Magang::where('user_id', Auth::id())
                        ->where('status', 'disetujui')
                        ->first();

        if (!$magang) {
            return redirect()->back()->with('error', 'Amelia, pengajuan magangmu belum disetujui Admin!');
        }

        // 3. Proses Upload File jika ada
        $filePath = null;
        if ($request->hasFile('file_lampiran')) {
            $filePath = $request->file('file_lampiran')->store('logbook_attachments', 'public');
        }

        // 4. Simpan Logbook
        Logbook::create([
            'magang_id'     => $magang->id,
            'tanggal'       => $request->tanggal,
            'kegiatan'      => $request->kegiatan,
            'file_lampiran' => $filePath, // Simpan path file
            'status'        => 'pending', // Default status awal
        ]);

        return redirect()->route('mahasiswa.logbook.index')
                         ->with('success', 'Amelia, logbook hari ini berhasil disimpan!');
}
public function show($id)
    {
        // Cari langsung berdasarkan ID tanpa mengecek user_id
        $logbook = Logbook::findOrFail($id);
        return view('mahasiswa.logbook.show', compact('logbook'));
    }

    public function edit($id)
    {
        // Cari langsung berdasarkan ID agar tidak error Unknown Column
        $logbook = Logbook::findOrFail($id);
        return view('mahasiswa.logbook.edit', compact('logbook'));
    }

    public function update(Request $request, $id)
    {
        $logbook = Logbook::findOrFail($id);
        
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required',
        ]);

        $logbook->update([
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
        ]);

        return redirect()->route('mahasiswa.logbook.index')->with('success', 'Catatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $logbook = Logbook::findOrFail($id);
        $logbook->delete();

        return redirect()->route('mahasiswa.logbook.index')->with('success', 'Catatan berhasil dihapus!');
    }
    
}
