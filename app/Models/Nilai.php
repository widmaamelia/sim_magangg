<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['magang_id', 'dosen_id', 'angka_nilai', 'keterangan'];

    public function magang()
    {
        // return $this->belongsTo(Magang::class);
        return $this->belongsTo(Magang::class, 'magang_id');
    }

    // Relasi untuk tahu dosen mana yang memberi nilai
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }
    public function mahasiswa()
    {
        // Sesuaikan 'mahasiswa_id' dengan nama kolom foreign key di tabel nilais kamu
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
    
}