<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $fillable = ['magang_id', 'tanggal', 'kegiatan', 'file_lampiran','status',
        'komentar_dosen'];

    public function magang()
    {
        return $this->belongsTo(Magang::class);
    }
}