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
        // 1. Buat tabel siswas (hanya biodata)
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nisn', 10)->unique();           // NISN unik 10 digit
            $table->string('kode_siswa', 10)->unique()->nullable(); // SISWA001 otomatis
            $table->string('nama_lengkap');
            $table->char('jenis_kelamin', 1)->check("jenis_kelamin IN ('L', 'P')"); // L atau P
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('foto')->nullable();             // Optional dari brief
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};