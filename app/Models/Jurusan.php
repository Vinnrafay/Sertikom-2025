<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_jurusan',
        'nama_jurusan'
    ];

    protected static function boot()
{
    parent::boot();

    static::creating(function ($jurusan) {
        if (empty($jurusan->kode_jurusan)) {
            // Ambil kode terakhir, tambah 1, format 3 digit
            $last = Jurusan::max('id'); // pakai id karena pasti urut
            $nextNumber = $last ? $last + 1 : 1;
            $jurusan->kode_jurusan = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        }
    });
}

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
}
