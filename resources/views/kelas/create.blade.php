<x-app-layout>
    <div class="p-10 ml-15">

        <!-- Back Button + Title -->
        <div class="flex items-center gap-3 mb-10">
            <a href="{{ route('kelas.index') }}"
               class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 transition">
                <i class="fa-solid fa-arrow-left text-gray-700"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Tambah Kelas Baru</h1>
        </div>

        <!-- CARD FORM -->
        <div class="bg-white p-10 rounded-2xl shadow-xl max-w-3xl mx-auto border border-gray-100">

            <h2 class="text-2xl font-bold mb-8 text-gray-700">Form Tambah Kelas</h2>

            <form action="{{ route('kelas.store') }}" method="POST">
                @csrf

                <!-- Nama Kelas -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-1">Nama Kelas</label>
                    <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 @error('nama_kelas') border-red-500 @enderror"
                           placeholder="Contoh: A, B, RPL-1, TKJ-2" required>
                    @error('nama_kelas')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Level Kelas -->
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-1">Tingkat Kelas</label>
                    <select name="level_kelas"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 @error('level_kelas') border-red-500 @enderror"
                            required>
                        <option value="">-- Pilih Tingkat --</option>
                        <option value="10" {{ old('level_kelas') == '10' ? 'selected' : '' }}>Kelas 10</option>
                        <option value="11" {{ old('level_kelas') == '11' ? 'selected' : '' }}>Kelas 11</option>
                        <option value="12" {{ old('level_kelas') == '12' ? 'selected' : '' }}>Kelas 12</option>
                    </select>
                    @error('level_kelas')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jurusan -->
                <div class="mb-8">
                    <label class="block text-gray-700 font-semibold mb-1">Jurusan</label>
                    <select name="jurusan_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 @error('jurusan_id') border-red-500 @enderror"
                            required>
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach($jurusan as $j)
                            <option value="{{ $j->id }}" {{ old('jurusan_id') == $j->id ? 'selected' : '' }}>
                                {{ $j->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                    @error('jurusan_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-save"></i>
                        Simpan
                    </button>
                    <a href="{{ route('kelas.index') }}"
                       class="bg-gray-500 text-white px-6 py-2.5 rounded-lg hover:bg-gray-600 transition flex items-center gap-2">
                        <i class="fa-solid fa-times"></i>
                        Batal
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>