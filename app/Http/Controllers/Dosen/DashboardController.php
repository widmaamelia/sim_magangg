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
        $dosenId = Auth::id();

        $magangs = Magang::with('mahasiswa')
    ->where('dosen_id', Auth::id())
    ->get();

        $total_bimbingan = $magangs->count();

        return view('dosen.dashboard', [
            'total_bimbingan' => $total_bimbingan,
            'magangs' => $magangs
        ]);
    }
}
