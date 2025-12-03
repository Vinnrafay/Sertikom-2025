<x-app-layout>
    <div class="p-10 ml-15">

        <!-- Header + Back Button -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('siswa.index') }}"
               class="w-11 h-11 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-gray-200 transition">
                <i class="fa-solid fa-arrow-left text-gray-700"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Tambah Siswa Baru</h1>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 max-w-4xl mx-auto">
            <div class="px-10 pt-10 pb-12">
                <form action="{{ route('siswa.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Biodata -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">NISN <span class="text-red-500">*</span></label>
                            <input type="text" name="nisn" value="{{ old('nisn') }}" maxlength="10"
                                   class="w-full px-5 py-3.5 border {{ $errors->has('nisn') ? 'border-red-400' : 'border-gray-300' }} rounded-xl focus:outline-none focus:ring-4 focus:ring-indigo-100"
                                   placeholder="Contoh: 0051234567" required>
                            @error('nisn') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                   class="w-full px-5 py-3.5 border {{ $errors->has('nama_lengkap') ? 'border-red-400' : 'border-gray-300' }} rounded-xl focus:outline-none focus:ring-4 focus:ring-indigo-100"
                                   placeholder="Contoh: Ahmad Fauzi" required>
                            @error('nama_lengkap') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jenis_kelamin" class="w-full px-5 py-3.5 border {{ $errors->has('jenis_kelamin') ? 'border-red-400' : 'border-gray-300' }} rounded-xl" required>
                                <option value="">Pilih jenis kelamin</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                   class="w-full px-5 py-3.5 border {{ $errors->has('tempat_lahir') ? 'border-red-400' : 'border-gray-300' }} rounded-xl" required>
                            @error('tempat_lahir') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                   class="w-full px-5 py-3.5 border {{ $errors->has('tanggal_lahir') ? 'border-red-400' : 'border-gray-300' }} rounded-xl" required>
                            @error('tanggal_lahir') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">No. Telepon</label>
                            <input type="text" name="no_telepon" value="{{ old('no_telepon') }}"
                                   class="w-full px-5 py-3.5 border border-gray-300 rounded-xl"
                                   placeholder="Contoh: 081234567890">
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Alamat</label>
                        <textarea name="alamat" rows="3"
                                  class="w-full px-5 py-3.5 border border-gray-300 rounded-xl resize-none">{{ old('alamat') }}</textarea>
                    </div>

                    <hr class="border-gray-200">

                    <!-- Penempatan Kelas (Kelas Aktif Pertama) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Tahun Ajar <span class="text-red-500">*</span></label>
                            <select name="tahun_ajar_id" class="w-full px-5 py-3.5 border {{ $errors->has('tahun_ajar_id') ? 'border-red-400' : 'border-gray-300' }} rounded-xl" required>
                                <option value="">Pilih tahun ajar</option>
                                @foreach($tahunAjars as $ta)
                                    <option value="{{ $ta->id }}" {{ old('tahun_ajar_id') == $ta->id ? 'selected' : '' }}>
                                        {{ $ta->nama_tahun_ajar }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tahun_ajar_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Kelas <span class="text-red-500">*</span></label>
                            <select name="kelas_id" class="w-full px-5 py-3.5 border {{ $errors->has('kelas_id') ? 'border-red-400' : 'border-gray-300' }} rounded-xl" required>
                                <option value="">Pilih kelas</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id }}" {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kelas }} - {{ $k->jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Preview Kode Siswa Otomatis -->
                    <div class="bg-indigo-50 border-2 border-dashed border-indigo-200 rounded-xl p-6 text-center">
                        <p class="text-sm text-indigo-700 font-medium mb-2">Kode Siswa Otomatis</p>
                        <div class="inline-block bg-white px-8 py-4 rounded-lg shadow font-mono text-2xl font-bold text-indigo-700">
                            SISWA{{ str_pad(\App\Models\Siswa::max('id') ? \App\Models\Siswa::max('id') + 1 : 1, 3, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('siswa.index') }}"
                           class="px-8 py-3.5 rounded-xl bg-gray-500 hover:bg-gray-600 text-white font-medium transition flex items-center gap-2">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-10 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 hover:to-purple-700 text-white font-bold transition flex items-center gap-3 shadow-lg hover:shadow-xl">
                            Simpan Siswa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>