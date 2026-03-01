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
    $pengajuan_per_bulan = [];

    for ($i = 1; $i <= 12; $i++) {
        $pengajuan_per_bulan[] = Magang::whereMonth('created_at', $i)->count();
    }

    $data = [
        'total_dosen' => User::where('role', 'dosen')->count(),
        'total_mahasiswa' => User::where('role', 'mahasiswa')->count(),
        'total_pengajuan' => Magang::count(),
        'pengajuan_per_bulan' => $pengajuan_per_bulan,
    ];
    
    return view('admin.dashboard', $data);
}
}
