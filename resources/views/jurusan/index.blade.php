<x-app-layout>
    <div class="p-10 ml-15">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Jurusan</h1>

            <div class="flex items-center gap-4">
                <a href="{{ route('jurusan.create') }}"
                   class="bg-indigo-600 text-white px-5 py-2.5 rounded-full font-medium hover:bg-indigo-700 transition flex items-center gap-2">
                    Tambah Jurusan
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
        </div>

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-3 rounded-lg flex items-center gap-2">
                <i class="fa-solid fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-3 rounded-lg flex items-center gap-2">
                <i class="fa-solid fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">

            <table class="w-full text-left table-fixed">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 border-b">
                        <th class="py-3 px-6 text-sm w-40">Kode Jurusan</th>
                        <th class="py-3 px-6 text-sm">Nama Jurusan</th>
                        <th class="py-3 px-6 text-sm w-40 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $item)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="py-3 px-6 align-middle font-mono font-semibold text-indigo-700">
                                {{ $item->kode_jurusan }}
                            </td>

                            <td class="py-3 px-6 align-middle">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-graduation-cap text-indigo-600"></i>
                                    {{ $item->nama_jurusan }}
                                </div>
                            </td>

                            <td class="py-3 px-6 align-middle">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('jurusan.edit', $item) }}"
                                       class="px-3 py-1.5 border border-gray-400 rounded-lg text-gray-700 hover:bg-gray-100 transition text-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('jurusan.destroy', $item) }}" 
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus jurusan {{ $item->nama_jurusan }}?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-4 py-1.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-12 text-gray-500">
                                <i class="fa-solid fa-inbox text-4xl mb-3 block"></i>
                                Belum ada data jurusan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

    </div>
</x-app-layout>