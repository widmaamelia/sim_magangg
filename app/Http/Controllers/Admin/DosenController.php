<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use App\Models\User;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = User::where('role', 'dosen')->get();
        return view('admin.dosen.index', compact('dosens'));
    }

    public function show(User $dosen)
    {
        return view('admin.dosen.show', compact('dosen'));
    }

    public function edit(User $dosen)
    {
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, User $dosen)
    {
        $data = [
            'name' => $request->name,
            'identity_number' => $request->identity_number,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $dosen->update($data);

        return redirect()
            ->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil diperbarui!');
    }
    
    // Fungsi untuk menampilkan halaman form input nilai
    public function create(Request $request)
    {
        return view('admin.dosen.create');
    }

    public function destroy(User $dosen)
    {
        $dosen->delete();

        return back()->with('success', 'Data dosen berhasil dihapus!');
    }
    public function store(Request $request)
{
    // 1. Validasi data
    $request->validate([
        'identity_number' => 'required|unique:users,identity_number', // sesuaikan tabelmu
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    // 2. Simpan ke database
    // Pastikan kamu menggunakan Model yang benar (misal: User atau Dosen)
    User::create([
        'identity_number' => $request->identity_number,
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'dosen', // Jika kamu pakai sistem role
    ]);

    // 3. Redirect kembali ke index
    return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil ditambahkan!');
}

}