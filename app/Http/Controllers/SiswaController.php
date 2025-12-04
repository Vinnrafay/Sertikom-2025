<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\KelasDetail;
use App\Models\Kelas;
use App\Models\TahunAjar;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query()->with(['kelasAktif.kelas.jurusan', 'kelasAktif.tahunAjar']);

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_lengkap', 'like', '%' . $request->search . '%')
                  ->orWhere('nisn', $request->search);
            });
        }

        // Filter jurusan
        if ($request->filled('jurusan_id')) {
            $query->whereHas('kelasAktif.kelas', fn($q) =>
                $q->where('jurusan_id', $request->jurusan_id)
            );
        }

        // Filter kelas
        if ($request->filled('kelas_id')) {
            $query->whereHas('kelasAktif', fn($q) =>
                $q->where('kelas_id', $request->kelas_id)
            );
        }

        /** =====================================
         * PAGINATION & DROPDOWN FIX
         * =================================== */

        // Ambil data tabel pakai pagination
        // ->withQueryString() = supaya page tetap ikut filter
        $data = $query
            ->orderBy('nama_lengkap')
            ->paginate(7)
            ->withQueryString();

        // Dropdown jurusan
        $jurusan = \App\Models\Jurusan::orderBy('nama_jurusan')->get();

        // Dropdown kelas (auto filter sesuai jurusan)
        $kelas = Kelas::with('jurusan')
            ->when($request->filled('jurusan_id'), function ($q) use ($request) {
                $q->where('jurusan_id', $request->jurusan_id);
            })
            ->orderBy('level_kelas')
            ->orderBy('nama_kelas')
            ->get();

        // Dropdown tahun ajar (kalau nanti dipakai)
        $tahunAjars = TahunAjar::orderBy('nama_tahun_ajar')->get();

        return view('siswa.index', [
            'data'       => $data,
            'kelas'      => $kelas,
            'jurusan'    => $jurusan,
            'tahunAjars' => $tahunAjars,
        ]);
    }


    public function create()
    {
        $kelas = Kelas::with('jurusan')->get();
        $tahunAjars = TahunAjar::all();
        return view('siswa.create', compact('kelas', 'tahunAjars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|digits:10|unique:siswas,nisn',
            'nama_lengkap' => 'required|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable',
            'no_telepon' => 'nullable',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajar_id' => 'required|exists:tahun_ajars,id',
        ]);

        // Auto kode siswa
        $last = Siswa::max('id');
        $kode = 'SISWA' . str_pad(($last ? $last + 1 : 1), 3, '0', STR_PAD_LEFT);

        $siswa = Siswa::create(
            $request->only(['nisn','nama_lengkap','jenis_kelamin','tempat_lahir','tanggal_lahir','alamat','no_telepon'])
            + ['kode_siswa' => $kode]
        );

        // Kelas aktif pertama
        KelasDetail::create([
            'siswa_id' => $siswa->id,
            'kelas_id' => $request->kelas_id,
            'tahun_ajar_id' => $request->tahun_ajar_id,
            'status' => 'aktif'
        ]);

        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
    }


    public function show(Siswa $siswa)
    {
        $siswa->load([
            'kelasAktif.kelas.jurusan',
            'kelasAktif.tahunAjar',
            'kelasDetails.kelas.jurusan',
            'kelasDetails.tahunAjar'
        ]);

        $kelas = Kelas::with('jurusan')->get();
        $tahunAjar = TahunAjar::all();
        $riwayat = $siswa->kelasDetails()->latest()->paginate(5);

        return view('siswa.show', compact('siswa', 'kelas', 'tahunAjar', 'riwayat'));
    }

    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::with('jurusan')->get();
        $tahunAjars = TahunAjar::all();
        $current = $siswa->kelasAktif;

        return view('siswa.edit', compact('siswa', 'kelas', 'tahunAjars', 'current'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nisn' => ['required','digits:10', Rule::unique('siswas')->ignore($siswa->id)],
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajar_id' => 'required|exists:tahun_ajars,id',
        ]);

        $siswa->update($request->only([
            'nisn','nama_lengkap','jenis_kelamin','tempat_lahir','tanggal_lahir','alamat','no_telepon'
        ]));

        // Update kelas jika berubah
        $current = $siswa->kelasAktif;

        if ($current &&
            ($current->kelas_id != $request->kelas_id ||
             $current->tahun_ajar_id != $request->tahun_ajar_id)
        ) {
            $current->update(['status' => 'nonaktif']);

            KelasDetail::create([
                'siswa_id' => $siswa->id,
                'kelas_id' => $request->kelas_id,
                'tahun_ajar_id' => $request->tahun_ajar_id,
                'status' => 'aktif'
            ]);
        }

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->kelasDetails()->delete();
        $siswa->delete();

        return back()->with('success', 'Siswa berhasil dihapus!');
    }

    public function updateKelas(Request $request, Siswa $siswa)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajar_id' => 'required|exists:tahun_ajars,id'
        ]);

        $current = $siswa->kelasAktif;

        if ($current &&
            $current->kelas_id == $request->kelas_id &&
            $current->tahun_ajar_id == $request->tahun_ajar_id) {
            return back()->with('info', 'Tidak ada perubahan data.');
        }

        $sudahPernah = $siswa->kelasDetails()
            ->where('kelas_id', $request->kelas_id)
            ->where('tahun_ajar_id', $request->tahun_ajar_id)
            ->exists();

        if ($sudahPernah) {
            return back()->with('error', 'Tidak bisa mengubah siswa ke kelas & tahun ajar yang sudah pernah digunakan sebelumnya.');
        }

        if ($current) {
            $current->update(['status' => 'nonaktif']);
        }

        KelasDetail::create([
            'siswa_id' => $siswa->id,
            'kelas_id' => $request->kelas_id,
            'tahun_ajar_id' => $request->tahun_ajar_id,
            'status' => 'aktif',
        ]);

        return back()->with('success', 'Kelas & Tahun Ajar berhasil diperbarui.');
    }
}
