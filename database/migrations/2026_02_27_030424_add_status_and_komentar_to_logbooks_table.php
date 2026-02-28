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
        Schema::table('logbooks', function (Blueprint $table) {
            $table->enum('status', ['pending', 'acc'])->default('pending')->after('file_lampiran');
        $table->text('komentar_dosen')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logbooks', function (Blueprint $table) {
            $table->string('file_sertifikat')->nullable()->after('status');
        });
    }
};
