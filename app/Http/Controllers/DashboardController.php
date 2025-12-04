<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\TahunAjar;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
              'totalSiswa'   => Siswa::count(),
                'totalKelas'   => Kelas::count(),
                'totalJurusan' => Jurusan::count(),
                'totalTahun'   => TahunAjar::count(),
                'siswaBaru' => Siswa::with(['kelasAktif.kelas.jurusan'])
            ->latest()
            ->paginate(5)     
            ->withQueryString(),   
        ]);
    }
}
