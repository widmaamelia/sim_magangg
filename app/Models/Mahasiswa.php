<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'mahasiswas';

    // Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'identity_number', // NIM
        'name',
        'email',
        'kelas',           // Penting untuk filter MI3A, MI3B, dll
        'phone',
        'status',
    ];

    /**
     * Relasi: Satu mahasiswa bisa punya banyak pengajuan magang
     */
    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'mahasiswa_id');
    }
}