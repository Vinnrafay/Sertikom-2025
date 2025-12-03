<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn',
        'kode_siswa',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'foto',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Relasi ke tabel kelas_details (riwayat kelas)
     */
    public function kelasDetails()
    {
        return $this->hasMany(KelasDetail::class, 'siswa_id');
    }

    /**
     * Relasi kelas aktif (yang status = aktif)
     */
    public function kelasAktif()
    {
        return $this->hasOne(KelasDetail::class, 'siswa_id')->where('status', 'aktif');
    }
}
