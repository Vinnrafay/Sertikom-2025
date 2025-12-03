<x-app-layout>
    <div class="p-10 ml-15">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('siswa.index') }}"
               class="w-11 h-11 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-gray-200 transition">
                <i class="fa-solid fa-arrow-left text-gray-700"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Edit Siswa: {{ $siswa->nama_lengkap }}</h1>
        </div>

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 max-w-4xl mx-auto">
            <div class="px-10 pt-10 pb-12">
                <form action="{{ route('siswa.update', $siswa) }}" method="POST" class="space-y-8">
                    @csrf @method('PUT')

                    <!-- Sama persis seperti create, cuma value diambil dari $siswa -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">NISN <span class="text-red-500">*</span></label>
                            <input type="text" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" maxlength="10"
                                   class="w-full px-5 py-3.5 border {{ $errors->has('nisn') ? 'border-red-400' : 'border-gray-300' }} rounded-xl" required>
                            @error('nisn') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Kode Siswa</label>
                            <div class="w-full px-5 py-3.5 bg-gray-100 rounded-xl font-mono text-lg font-bold text-indigo-700">
                                {{ $siswa->kode_siswa }}
                            </div>
                        </div>
                        <!-- Sisanya sama, tinggal ganti old() jadi old('field', $siswa->field) -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}" required
                                   class="w-full px-5 py-3.5 border {{ $errors->has('nama_lengkap') ? 'border-red-400' : 'border-gray-300' }} rounded-xl">
                            @error('nama_lengkap') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <!-- ... dan seterusnya (jenis_kelamin, tempat_lahir, dll) -->

                        <!-- Kelas & Tahun Ajar (pre-select kelas aktif) -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tahun Ajar Saat Ini</label>
                            <select name="tahun_ajar_id" class="w-full px-5 py-3.5 border rounded-xl" required>
                                @foreach($tahunAjars as $ta)
                                    <option value="{{ $ta->id }}" 
                                        {{ old('tahun_ajar_id', $current?->tahun_ajar_id) == $ta->id ? 'selected' : '' }}>
                                        {{ $ta->nama_tahun_ajar }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Kelas Saat Ini</label>
                            <select name="kelas_id" class="w-full px-5 py-3.5 border rounded-xl" required>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id }}" 
                                        {{ old('kelas_id', $current?->kelas_id) == $k->id ? 'selected' : '' }}>
                                        {{ $k->level_kelas }} {{ $k->nama_kelas }} - {{ $k->jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Tombol Update -->
                    <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('siswa.index') }}" class="px-8 py-3.5 rounded-xl bg-gray-500 hover:bg-gray-600 text-white font-medium transition">
                            Batal
                        </a>
                        <button type="submit" class="px-10 py-3.5 rounded-xl bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold transition shadow-lg hover:shadow-xl">
                            Update Data Siswa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>