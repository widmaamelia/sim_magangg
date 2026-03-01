<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('magangs', function (Blueprint $table) {
            // Kolom ini wajib ada agar update nilai dari Dosen berhasil
            $table->integer('angka_nilai')->nullable()->after('dosen_id');
        });
    }

    public function down(): void
    {
        Schema::table('magangs', function (Blueprint $table) {
            $table->dropColumn('angka_nilai');
        });
    }
};