<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    // Nama tabel jika tidak jamak (optional, Laravel otomatis anggap 'pengajuans')
    protected $table = 'pengajuans';

    /**
     * Mass Assignment: Daftar kolom yang boleh diisi secara massal.
     * Pastikan 'dosen_id' dan 'status' ada di sini agar bisa diupdate oleh Admin.
     */
    protected $fillable = [
        'mahasiswa_id',
        'dosen_id',      // Penting untuk simpan pembimbing
        'nama_perusahaan',
        'alamat_perusahaan',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',        // Penting untuk update (pending/disetujui/ditolak)
        'keterangan',
    ];

    /**
     * Relasi ke Model Mahasiswa
     */
    public function mahasiswa()
{
    // Gunakan User::class karena mahasiswamu adalah User
    return $this->belongsTo(User::class, 'mahasiswa_id');
}

public function dosen()
{
    return $this->belongsTo(User::class, 'dosen_id');
}
}