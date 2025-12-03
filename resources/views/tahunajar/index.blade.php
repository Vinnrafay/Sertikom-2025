<x-app-layout>
    <div class="p-10 ml-15">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Tahun Ajar</h1>

            <div class="flex items-center gap-4">
                <a href="{{ route('tahunajar.create') }}"
                   class="bg-indigo-600 text-white px-5 py-2.5 rounded-full font-medium hover:bg-indigo-700 transition flex items-center gap-2">
                    Tambah Tahun Ajar
                </a>
            </div>
        </div>

        <!-- Notifikasi (opsional, boleh ditambah kalau perlu) -->
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-3 rounded-lg flex items-center gap-2">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">

            <table class="w-full text-left table-fixed">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 border-b">
                        <th class="py-3 px-6 text-sm w-40">Kode Tahun</th>
                        <th class="py-3 px-6 text-sm">Nama</th>
                        <th class="py-3 px-6 text-sm w-40 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $item)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="py-3 px-6 align-middle font-mono font-semibold text-indigo-700">
                                {{ $item->kode_tahun_ajar }}
                            </td>

                            <td class="py-3 px-6 align-middle">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-calendar-days text-indigo-600"></i>
                                    {{ $item->nama_tahun_ajar }}
                                </div>
                            </td>

                            <td class="py-3 px-6 align-middle">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('tahunajar.edit', $item) }}"
                                       class="px-3 py-1.5 border border-gray-400 rounded-lg text-gray-700 hover:bg-gray-100 transition text-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('tahunajar.destroy', $item) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus tahun ajar {{ $item->nama_tahun_ajar }}?')">
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
                            <td colspan="3" class="text-center py-16 text-gray-500">
                                <i class="fa-solid fa-inbox text-5xl mb-4 block text-gray-500"></i>
                                <p class="text-lg font-medium">Data belum di input</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Total Data -->
        @if($data->count() > 0)
            <div class="mt-6 text-sm text-gray-600">
                Total: <span class="font-bold text-indigo-600">{{ $data->count() }}</span> tahun ajar
            </div>
        @endif

    </div>
</x-app-layout>