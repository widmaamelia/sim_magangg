<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'identity_number', // NIM atau NIP
        'role',
        'kelas',
    ];

    // Relasi: Jika user adalah Mahasiswa, dia punya data Magang
    public function magangs()
    {
        return $this->hasMany(Magang::class, 'user_id');
    }

    // RELASI DOSEN: Jika user adalah Dosen, dia membimbing banyak mahasiswa magang
    public function bimbingan()
    {
        return $this->hasMany(Magang::class, 'dosen_id');
    }
    
}