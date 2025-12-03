<x-app-layout>
    <div class="p-10 ml-15">
        <div class="flex items-center gap-3 mb-10">
            <a href="{{ route('jurusan.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200">
                <i class="fa-solid fa-arrow-left text-gray-700"></i>
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Edit Jurusan</h1>
        </div>

        <div class="bg-white p-10 rounded-2xl shadow-xl max-w-3xl mx-auto border border-gray-100">
            <form action="{{ route('jurusan.update', $jurusan) }}" method="POST">
                @csrf
                @method('PUT')

            <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-1">Kode Jurusan</label>
            <div class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-2.5 font-mono font-bold text-indigo-700">
                {{ $jurusan->kode_jurusan }}
            </div>
            <p class="text-xs text-gray-500 mt-1">Kode ini otomatis dan tidak dapat diubah.</p>
        </div>

                <div class="mb-8">
                    <label class="block text-gray-700 font-semibold mb-1">Nama Jurusan</label>
                    <input type="text" name="nama_jurusan" value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 @error('nama_jurusan') border-red-500 @enderror" required>
                    @error('nama_jurusan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 flex items-center gap-2">
                        <i class="fa-solid fa-save"></i> Update
                    </button>
                    <a href="{{ route('jurusan.index') }}" class="bg-gray-500 text-white px-6 py-2.5 rounded-lg hover:bg-gray-600 flex items-center gap-2">
                        <i class="fa-solid fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>