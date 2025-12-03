<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JurusanController extends Controller
{
    /** Daftar semua jurusan */
    public function index()
    {
        $data = Jurusan::orderBy('kode_jurusan')->get();

        return view('jurusan.index', compact('data'));
    }

    /** Form tambah jurusan */
    public function create()
    {
        return view('jurusan.create');
    }

    /** Simpan jurusan baru */
public function store(Request $request)
{
    $request->validate([
        'nama_jurusan' => 'required|string|max:100',
        // kode_jurusan tidak divalidasi lagi → otomatis dari model
    ]);

    Jurusan::create([
        'nama_jurusan' => $request->nama_jurusan,
        // kode_jurusan akan otomatis terisi di event creating
    ]);

    return redirect()->route('jurusan.index')
                     ->with('success', 'Jurusan berhasil ditambahkan!');
}

    /** Form edit jurusan */
    public function edit(Jurusan $jurusan)   // ← huruf kecil!
    {
        return view('jurusan.edit', compact('jurusan'));
    }

    /** Update jurusan */
    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'kode_jurusan' => [
                'required',
                'string',
                'max:10',
                Rule::unique('jurusans', 'kode_jurusan')->ignore($jurusan->id),
            ],
            'nama_jurusan' => 'required|string|max:100',
        ], [
            'kode_jurusan.unique' => 'Kode jurusan sudah digunakan oleh jurusan lain.',
        ]);

        $jurusan->update($request->only(['kode_jurusan', 'nama_jurusan']));

        return redirect()->route('jurusan.index')
                         ->with('success', 'Jurusan berhasil diperbarui!');
    }

    public function destroy(Jurusan $jurusan)
    {
        // Kalau ada kelas yang pakai jurusan ini, akan error karena foreign key constraint
        // (cascadeOnDelete di migration Kelas). Bisa ditangkap dengan try-catch kalau mau.
        try {
            $jurusan->delete();
            return redirect()->route('jurusan.index')
                             ->with('success', 'Jurusan berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('jurusan.index')
                             ->with('error', 'Jurusan tidak bisa dihapus karena masih digunakan di data Kelas.');
        }
    }
}