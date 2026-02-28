<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    protected $fillable = [
        'user_id', 
        'dosen_id', // Menunjuk ke User dengan role dosen
        'nama_perusahaan', 
        'alamat_perusahaan', 
        'tanggal_mulai', 
        'tanggal_selesai', 
        'status',
        'angka_nilai'
    ];

    // Relasi balik ke Mahasiswa (User)
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // RELASI KE DOSEN: Mengambil data dosen pembimbing
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }

    // Satu pengajuan magang punya banyak catatan harian
    public function logbooks()
    {
        return $this->hasMany(Logbook::class);
    }
    public function nilai()
    {
        // Hubungkan berdasarkan kolom magang_id yang ada di tabel nilais
        return $this->hasOne(Nilai::class, 'magang_id');
    }
}