<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil status magang mahasiswa yang sedang login
        $magang = Magang::where('user_id', Auth::id())->first();
        
        return view('mahasiswa.dashboard', compact('magang'));
    }
}
