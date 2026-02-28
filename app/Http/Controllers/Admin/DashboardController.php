<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data ringkas untuk dashboard admin
        $data = [
            'total_dosen' => User::where('role', 'dosen')->count(),
            'total_mahasiswa' => User::where('role', 'mahasiswa')->count(),
            'total_pengajuan' => Magang::count(),
        ];
        
        return view('admin.dashboard', $data);
    }
}
