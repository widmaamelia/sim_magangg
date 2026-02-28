<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data mahasiswa yang dibimbing oleh dosen yang sedang login
        $total_bimbingan = Magang::where('dosen_id', Auth::id())->count();
        
        return view('dosen.dashboard', compact('total_bimbingan'));
    }
}
