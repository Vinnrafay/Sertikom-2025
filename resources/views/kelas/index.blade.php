<x-app-layout>
    <div class="p-10 ml-15">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Kelas</h1>

            <div class="flex items-center gap-4">
                <a href="{{ route('kelas.create') }}"
                   class="bg-indigo-600 text-white px-5 py-2.5 rounded-full font-medium hover:bg-indigo-700 transition flex items-center gap-2">
                    Tambah Kelas
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

        <!-- Table -->
        <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">

            <table class="w-full text-left table-fixed">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 border-b">
                        <th class="py-3 px-6 text-sm w-16">No</th>
                        <th class="py-3 px-6 text-sm">Tingkat Kelas</th>
                        <th class="py-3 px-6 text-sm">Nama Kelas</th>
                        <th class="py-3 px-6 text-sm">Jurusan</th>
                        <th class="py-3 px-6 text-sm w-40 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $item)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="py-3 px-6 align-middle text-center text-gray-600">
                                {{ $loop->iteration }}
                            </td>

                            <td class="py-3 px-6 align-middle">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-school text-indigo-600"></i>
                                    <span class="font-medium">{{ $item->level_kelas }}</span>
                                </div>
                            </td>

                               <td class="py-3 px-6 align-middle">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-school text-indigo-600"></i>
                                    <span class="font-medium">{{ $item->nama_kelas }}</span>
                                </div>
                            </td>

                            <td class="py-3 px-6 align-middle">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-graduation-cap text-purple-600"></i>
                                    {{ $item->jurusan->nama_jurusan ?? '-' }}
                                </div>
                            </td>

                            <td class="py-3 px-6 align-middle">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('kelas.edit', $item) }}"
                                       class="px-3 py-1.5 border border-gray-400 rounded-lg text-gray-700 hover:bg-gray-100 transition text-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('kelas.destroy', $item) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus kelas {{ $item->level_kelas }} {{ $item->nama_kelas }}?')">
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
                            <td colspan="4" class="text-center py-12 text-gray-500">
                                <i class="fa-solid fa-inbox text-4xl mb-3 block"></i>
                                Belum ada data kelas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


    </div>
</x-app-layout>