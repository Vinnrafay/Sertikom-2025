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
        Schema::create('kelas_details', function (Blueprint $table) {
            $table->id();
            
            // FK ke siswa
            $table->foreignId('siswa_id')
                  ->constrained('siswas')
                  ->onDelete('cascade');
                  
            // FK ke kelas
            $table->foreignId('kelas_id')
                  ->constrained('kelas')
                  ->onDelete('cascade');
                  
            // FK ke tahun ajar
            $table->foreignId('tahun_ajar_id')
                  ->constrained('tahun_ajars')
                  ->onDelete('cascade');
                  
            // Status aktif / tidak aktif
            $table->enum('status', ['aktif', 'nonaktif'])
                  ->default('aktif');
                  
            $table->timestamps();

            $table->unique(['siswa_id', 'tahun_ajar_id', 'status'], 'unique_active_per_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_details');
    }
};