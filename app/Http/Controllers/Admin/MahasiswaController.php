<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
   // Menampilkan daftar semua mahasiswa
    public function index()
    {
        //Ambil user yang rolenya mahasiswa (Urutkan dari yang terbaru agar Amelia mudah cek)
        $mahasiswas = User::where('role', 'mahasiswa')->latest()->get();
        
        // Pastikan variabel ini dikirim ke view
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    // --- FUNGSI BARU: Menampilkan daftar pengajuan yang butuh persetujuan ---
    public function pengajuan()
    {
        // 1. Ambil data pengajuan (Status pending)
    $pengajuans = Magang::with(['mahasiswa', 'dosen'])->latest()->get();
    
    // 2. Ambil data semua user yang rolenya 'dosen' (INI YANG PENTING)
    $dosens = User::where('role', 'dosen')->get();
    
    // 3. Kirim KEDUA variabel tersebut ke View
    // Pastikan ada 'dosens' di dalam kurung compact
    return view('admin.pengajuan.index', compact('pengajuans', 'dosens'));
    }
    public function tentukanPembimbing(Request $request, $id)
    {
        $request->validate([
            'dosen_id' => 'required|exists:users,id'
        ]);

        $magang = Magang::findOrFail($id);
        $magang->update([
            'dosen_id' => $request->dosen_id
        ]);

        return redirect()->back()->with('success', 'Dosen pembimbing berhasil ditentukan!');
    }

    // --- FUNGSI BARU: Melakukan Approve pengajuan ---
    public function approve(Request $request, $id)
    {
        $magang = Magang::findOrFail($id);
        $magang->update([
            'status' => 'disetujui'
        ]);

        return redirect()->back()->with('success', 'Amelia, pengajuan magang berhasil disetujui!');
    }

    // Fungsi Tambah Mahasiswa Manual (CRUD)
    public function store(Request $request)
    {
       // 1. Validasi (Laravel otomatis redirect back jika gagal)
    $validated = $request->validate([
        'identity_number' => 'required|unique:users',
        'name'            => 'required',
        'email'           => 'required|email|unique:users',
        'kelas'           => 'required', 
        'password'        => 'required|min:8', // Ini yang memicu error minimal 8 karakter
    ]);

    // 2. Eksekusi Simpan
    User::create([
        'identity_number' => $request->identity_number,
        'name'            => $request->name,
        'email'           => $request->email,
        'kelas'           => $request->kelas,
        'password'        => bcrypt($request->password),
        'role'            => 'mahasiswa',
    ]);

    // Redirect ke index dengan pesan sukses
    return redirect()->route('admin.mahasiswa.index')
        ->with('success', 'Berhasil! Mahasiswa masuk ke kelas ' . $request->kelas);

    // } catch (\Exception $e) {
    //     // Jika error, Laravel akan menampilkan pesan error aslinya di layar
    //     // return dd($e->getMessage()); 
    // }
    }

    // Fungsi Hapus Mahasiswa
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Mahasiswa berhasil dihapus!');
    }
 // ✅ INI YANG TADI ERROR
    public function show($id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }

    // ✅ INI JUGA
    public function edit($id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

public function updateStatus(Request $request, $id)
{
    $magang = Magang::findOrFail($id);
    
    // Validasi: Kalau statusnya disetujui, dosen_id wajib diisi
    if($request->status == 'disetujui') {
        $request->validate([
            'dosen_id' => 'required'
        ]);
    }

    $magang->update([
        'status' => $request->status,
        'dosen_id' => $request->dosen_id // Simpan dosen pembimbing pilihan Admin
    ]);

    return back()->with('success', 'Status dan Dosen Pembimbing berhasil diperbarui!');
}
public function update(Request $request, $id)
{
    $mahasiswa = User::where('role', 'mahasiswa')->findOrFail($id);

    $request->validate([
        'name' => 'required',
        'identity_number' => 'required|unique:users,identity_number,' . $id,
        'email' => 'required|email|unique:users,email,' . $id,
    ]);

    $data = [
        'name' => $request->name,
        'identity_number' => $request->identity_number,
        'email' => $request->email,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $mahasiswa->update($data);

    return redirect()
        ->route('admin.mahasiswa.index')
        ->with('success', 'Data mahasiswa berhasil diperbarui');
}
    public function create()
    {
        return view('admin.mahasiswa.create');
    }
}
