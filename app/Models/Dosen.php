<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'user_id',
        'nip',
        'nidn',
        'prodi',
        'no_hp'
    ];

    /**
     * RELASI: Dosen ini dimiliki oleh seorang User.
     * Fungsinya: Agar kita bisa mengambil nama/email dosen dari model Dosen.
     * Contoh penggunaan: $dosen->user->name
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * RELASI: Dosen ini membimbing banyak pengajuan Magang.
     * Kita hubungkan 'user_id' dari tabel users (sebagai pembimbing)
     * ke 'dosen_id' di tabel magangs.
     */
    public function bimbingans()
    {
        return $this->hasMany(Magang::class, 'dosen_id', 'user_id');
    }
}