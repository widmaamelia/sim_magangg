<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sidang extends Model
{
    protected $fillable = [
        'magang_id', 'judul_laporan', 'file_laporan', 
        'file_nilai_industri', 'status', 'jadwal_sidang', 'lokasi_sidang'
    ];

    public function magang() {
        return $this->belongsTo(Magang::class);
    }
}