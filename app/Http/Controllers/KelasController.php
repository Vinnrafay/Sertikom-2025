<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $data = Kelas::with('jurusan')->orderBy('level_kelas')->orderBy('nama_kelas')->get();

        return view('kelas.index', compact('data'));
    }

    public function create()
    {
        $jurusan = Jurusan::orderBy('nama_jurusan')->get();
        return view('kelas.create', compact('jurusan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas'   => 'required|string|max:20',
            'level_kelas'  => 'required|in:10,11,12',
            'jurusan_id'   => 'required|exists:jurusans,id',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')
                         ->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function edit(Kelas $kelas) // ← pakai huruf kecil biar tidak error lagi!
    {
        $jurusan = Jurusan::orderBy('nama_jurusan')->get();
        return view('kelas.edit', compact('kelas', 'jurusan'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas'   => 'required|string|max:20',
            'level_kelas'  => 'required|in:10,11,12',
            'jurusan_id'   => 'required|exists:jurusans,id',
        ]);

        $kelas->update($request->all());

        return redirect()->route('kelas.index')
                         ->with('success', 'Kelas berhasil diperbarui!');
    }

    public function destroy(Kelas $kelas)
    {
        // Kalau ada siswa di kelas ini, mungkin mau kasih peringatan dulu
        // Tapi karena migration cascadeOnDelete, langsung hapus aman
        $kelas->delete();

        return redirect()->route('kelas.index')
                         ->with('success', 'Kelas berhasil dihapus!');
    }
}