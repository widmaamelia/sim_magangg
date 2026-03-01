<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sidangs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('magang_id')->constrained('magangs')->onDelete('cascade');
        $table->string('judul_laporan');
        $table->string('file_laporan');
        $table->string('file_nilai_industri');
        $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
        $table->dateTime('jadwal_sidang')->nullable();
        $table->string('lokasi_sidang')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidangs');
    }
};
