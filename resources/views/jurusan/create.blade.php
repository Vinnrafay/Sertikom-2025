<x-app-layout>
    <div class="p-10 ml-15">
    <!-- Back + Judul -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('jurusan.index') }}"
           class="w-11 h-11 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-gray-200 transition">
            <i class="fa-solid fa-arrow-left text-gray-700"></i>
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Tambah Jurusan Baru</h1>
    </div>

    <!-- Card Form -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 max-w-2xl mx-auto">
        <div class="px-10 pt-10 pb-12">

            <form action="{{ route('jurusan.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Nama Jurusan -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2 text-lg">
                        Nama Jurusan
                    </label>
                    <input type="text"
                           name="nama_jurusan"
                           value="{{ old('nama_jurusan') }}"
                           class="w-full px-5 py-3.5 text-base border {{ $errors->has('nama_jurusan') ? 'border-red-400 focus:border-red-500' : 'border-gray-300 focus:border-indigo-500' }} 
                                  rounded-xl focus:outline-none focus:ring-4 focus:ring-indigo-100 transition"
                           placeholder="Contoh: Rekayasa Perangkat Lunak"
                           required autofocus>

                    @error('nama_jurusan')
                        <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Preview Kode Otomatis – Lebih soft & clean -->
                <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-5 text-center">
                    <p class="text-sm text-indigo-700 font-medium mb-1">
                        <i class="fa-solid fa-info-circle mr-1"></i>
                        Kode jurusan akan otomatis dibuat
                    </p>
                    <div class="inline-block bg-white px-7 py-3 rounded-lg shadow-sm border border-indigo-200 font-mono text-2xl font-bold text-indigo-700 tracking-wider">
                        {{ str_pad(\App\Models\Jurusan::max('id') ? \App\Models\Jurusan::max('id') + 1 : 1, 3, '0', STR_PAD_LEFT) }}
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('jurusan.index') }}"
                       class="px-7 py-3 rounded-xl bg-gray-500 hover:bg-gray-600 text-white font-medium transition flex items-center gap-2">
                        <i class="fa-solid fa-times"></i> Batal
                    </a>

                    <button type="submit"
                            class="px-8 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium transition flex items-center gap-2 shadow-md hover:shadow-lg">
                        <i class="fa-solid fa-save"></i> Simpan Jurusan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
</x-app-layout>