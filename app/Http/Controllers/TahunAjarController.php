<?php

namespace App\Http\Controllers;

use App\Models\TahunAjar;
use Illuminate\Http\Request;

class TahunAjarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tahunajar.index', [
            'data' => TahunAjar::orderBy('kode_tahun_ajar')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tahunajar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_tahun_ajar' => 'required',
            'nama_tahun_ajar' => 'required',
        ]);

        TahunAjar::create([
            'kode_tahun_ajar' => $request->kode_tahun_ajar,
            'nama_tahun_ajar' => $request->nama_tahun_ajar,
        ]);

        return redirect()->route('tahunajar.index')
                         ->with('success', 'Tahun ajar berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
        public function edit(TahunAjar $tahunajar)
        {
            return view('tahunajar.edit', compact('tahunajar'));
        }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TahunAjar $tahunajar)
    {
        $request->validate([
            'kode_tahun_ajar' => 'required',
            'nama_tahun_ajar' => 'required',
        ]);

        $tahunajar->update([
            'kode_tahun_ajar' => $request->kode_tahun_ajar,
            'nama_tahun_ajar' => $request->nama_tahun_ajar,
        ]);

        return redirect()->route('tahunajar.index')
                         ->with('success', 'Tahun ajar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TahunAjar $tahunajar)
    {
        $tahunajar->delete();

        return redirect()->route('tahunajar.index')
                         ->with('success', 'Tahun ajar berhasil dihapus!');
    }
}
