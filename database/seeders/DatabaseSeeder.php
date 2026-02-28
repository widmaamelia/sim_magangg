<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'name'            => 'Administrator SIM',
            'email'           => 'admin@gmail.com',
            'password'        => Hash::make('password'),
            'identity_number' => '1001', // NIP Admin
            'role'            => 'admin',
        ]);

        // 2. Akun Dosen
        User::create([
            'name'            => 'Budi Santoso, M.T.',
            'email'           => 'dosen@gmail.com',
            'password'        => Hash::make('password'),
            'identity_number' => '19880101', // NIP Dosen
            'role'            => 'dosen',
        ]);

        // 3. Akun Mahasiswa
        User::create([
            'name'            => 'Amelia',
            'email'           => 'amelia@gmail.com',
            'password'        => Hash::make('password'),
            'identity_number' => '2024001', // NIM Mahasiswa
            'role'            => 'mahasiswa',
        ]);
    }
}
