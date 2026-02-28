<?php

use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dosen\MonitoringController;
use App\Http\Controllers\Dosen\PenilaianController;
use App\Http\Controllers\Mahasiswa\LogbookController;
use App\Http\Controllers\Mahasiswa\PengajuanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PengajuanController as AdminPengajuanController;

// Route::get('/', function () {
//     return view('welcome');
// });
// --- ROUTE GUEST (Belum Login) ---
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// --- ROUTE LOGOUT ---
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- ROUTE ADMIN (Hanya Role Admin) ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // CRUD Dosen & Mahasiswa
    // Gunakan full path jika belum di-import di atas
    Route::resource('dosen', \App\Http\Controllers\Admin\DosenController::class);
    Route::resource('mahasiswa', \App\Http\Controllers\Admin\MahasiswaController::class);

    // PENGAJUAN MAGANG (ADMIN)
    Route::get('/pengajuan', [AdminPengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/{id}', [AdminPengajuanController::class, 'show'])->name('pengajuan.show');
    Route::put('/pengajuan/{id}/terima', [AdminPengajuanController::class, 'terima'])->name('pengajuan.terima');
    Route::put('/pengajuan/{id}/tolak', [AdminPengajuanController::class, 'tolak'])->name('pengajuan.tolak');

    // Pilih salah satu saja untuk pembimbing (disarankan yang bawah agar lebih deskriptif)
    Route::put('/pengajuan/{id}/tentukan-pembimbing', [AdminPengajuanController::class, 'tentukanPembimbing'])
        ->name('pengajuan.tentukan-pembimbing');
});
// --- ROUTE DOSEN (Hanya Role Dosen) ---
Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Dosen\DashboardController::class, 'index'])->name('dashboard');
    // Nanti tambahkan route Monitoring & Penilaian di sini
    // TAMBAHKAN DUA BARIS INI:


    // Monitoring
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
    // Route untuk melihat daftar logbook
    Route::get('/dosen/monitoring/logbook/{id}', [MonitoringController::class, 'logbook'])->name('dosen.monitoring.logbook');

    // Route untuk memproses ACC/Komentar
    Route::post('/dosen/monitoring/logbook/review/{id}', [MonitoringController::class, 'reviewLogbook'])->name('dosen.logbook.updateStatus');
    // PERBAIKAN LOGBOOK: Hapus '/dosen' di depan URL dan 'dosen.' di depan name
    Route::get('/monitoring/logbook/{id}', [MonitoringController::class, 'logbook'])
        ->name('monitoring.logbook');
    // ✅ TAMBAHKAN ATAU PERBAIKI BARIS INI:
    Route::post('/monitoring/logbook/review/{id}', [MonitoringController::class, 'reviewLogbook'])
        ->name('logbook.updateStatus');
        

    // PERBAIKAN PENILAIAN: Samakan polanya
    Route::get('/penilaian/create/{id}', [PenilaianController::class, 'create'])
        ->name('penilaian.create');

    Route::resource('penilaian', PenilaianController::class)->except(['create', 'update']);
    Route::put('/penilaian/{id}', [PenilaianController::class, 'update'])->name('penilaian.update');
    Route::get('/penilaian/export/{kelas}', [PenilaianController::class, 'exportPDF'])->name('penilaian.export');
});

// --- ROUTE MAHASISWA (Hanya Role Mahasiswa) ---
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Mahasiswa\DashboardController::class, 'index'])->name('dashboard');
    // Nanti tambahkan route Pengajuan & Logbook di sini
    // Alamat Fitur Utama (Ini yang tadi bikin error)
    Route::resource('pengajuan', PengajuanController::class);
    Route::resource('logbook', LogbookController::class);
});
