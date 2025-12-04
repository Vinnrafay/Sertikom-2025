<x-app-layout>
    <div class="p-10 ml-15">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Data Siswa</h1>

            <a href="{{ route('siswa.create') }}"
                class="bg-indigo-600 text-white px-5 py-2.5 rounded-full font-semibold hover:bg-indigo-700 transition flex items-center gap-2 shadow">
                <i class="fa-solid fa-plus text-sm"></i>
                Tambah Siswa
            </a>
        </div>

        <!-- FILTER + SEARCH -->
        <form method="GET" class="mb-8 bg-white p-6 rounded-xl shadow border border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <!-- Search -->
                <div class="relative">
                    <input type="text" name="search" placeholder="Cari nama / NISN..."
                        value="{{ request('search') }}"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 pl-11">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-3.5 text-gray-400"></i>
                </div>

                <!-- Jurusan -->
                <select name="jurusan_id"
                    class="px-4 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500"
                    onchange="
                        this.form.querySelector('[name=kelas_id]').value='';
                        this.form.submit();
                    ">

                    <option value="">Semua Jurusan</option>

                    @foreach ($jurusan as $j)
                        <option value="{{ $j->id }}" {{ request('jurusan_id') == $j->id ? 'selected' : '' }}>
                            {{ $j->nama_jurusan }}
                        </option>
                    @endforeach
                </select>

                <!-- Kelas -->
                <select name="kelas_id"
                    class="px-4 py-3 rounded-xl border border-gray-300 bg-white focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500">

                    <option value="">Semua Kelas</option>

                    @foreach ($kelas as $k)
                        <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->level_kelas }} {{ $k->nama_kelas }} - {{ $k->jurusan->nama_jurusan }}
                        </option>
                    @endforeach

                </select>

                <!-- Filter Button -->
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-medium hover:bg-indigo-700 transition shadow">
                    Filter
                </button>
            </div>
        </form>

        <!-- TABLE -->
        <div class="bg-white shadow border border-gray-200 rounded-xl overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 border-b text-gray-600">
                        <th class="py-3 px-6 text-sm font-semibold">Kode</th>
                        <th class="py-3 px-6 text-sm font-semibold">NISN</th>
                        <th class="py-3 px-6 text-sm font-semibold">Nama</th>
                        <th class="py-3 px-6 text-sm font-semibold">Kelas Saat Ini</th>
                        <th class="py-3 px-6 text-sm text-center font-semibold w-40">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($data as $s)
                        <tr class="hover:bg-gray-50">

                            <td class="py-3 px-6 font-mono font-bold text-indigo-700">
                                {{ $s->kode_siswa }}
                            </td>

                            <td class="py-3 px-6">{{ $s->nisn }}</td>

                            <td class="py-3 px-6 font-medium">{{ $s->nama_lengkap }}</td>

                            <td class="py-3 px-6">
                                @if($s->kelasAktif)
                                    <span class="font-semibold text-gray-800">
                                        {{ $s->kelasAktif->kelas->level_kelas }}
                                        {{ $s->kelasAktif->kelas->nama_kelas }}
                                    </span>
                                    <span class="text-gray-500 text-sm">
                                        ({{ $s->kelasAktif->tahunAjar->nama_tahun_ajar }})
                                    </span>
                                @else
                                    <span class="text-gray-400 italic">Belum ditempatkan</span>
                                @endif
                            </td>

                            <!-- ACTION BUTTONS -->
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center gap-4 text-sm font-semibold">

                                    <a href="{{ route('siswa.show', $s) }}"
                                        class="text-indigo-600 hover:text-indigo-800 transition">
                                        Detail
                                    </a>

                                    <a href="{{ route('siswa.edit', $s) }}"
                                        class="text-yellow-600 hover:text-yellow-800 transition">
                                        Edit
                                    </a>

                                    <form action="{{ route('siswa.destroy', $s) }}" method="POST"
                                        onsubmit="return confirm('Hapus siswa ini?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 transition">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-16 text-center text-gray-500">
                                <i class="fa-solid fa-inbox text-5xl text-gray-300 mb-4 block"></i>
                                <span class="text-lg font-medium">Belum ada data siswa</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
@if ($data->hasPages())
    <div class="mt-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        {{-- Info --}}
        <div class="text-gray-600 text-sm">
            Menampilkan 
            <span class="font-semibold">{{ $data->firstItem() }}</span> 
            sampai 
            <span class="font-semibold">{{ $data->lastItem() }}</span> 
            dari 
            <span class="font-semibold">{{ $data->total() }}</span> data
        </div>

        {{-- Pagination Links --}}
        <div class="flex items-center gap-2">

            {{-- Previous --}}
            @if ($data->onFirstPage())
                <span class="px-3 py-2 bg-gray-200 text-gray-400 rounded-lg text-sm cursor-not-allowed">
                    <i class="fa-solid fa-angle-left"></i>
                </span>
            @else
                <a href="{{ $data->previousPageUrl() }}{{ request()->getQueryString() ? '&'.request()->getQueryString() : '' }}"
                   class="px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50 flex items-center">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
            @endif

            {{-- Numbered Pages --}}
            @php
                $start = max($data->currentPage() - 2, 1);
                $end   = min($data->currentPage() + 2, $data->lastPage());
            @endphp

            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $data->currentPage())
                    <span class="px-3 py-2 bg-indigo-600 text-white rounded-lg text-sm font-semibold">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $data->url($page) }}{{ request()->getQueryString() ? '&'.request()->getQueryString() : '' }}"
                       class="px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50">
                        {{ $page }}
                    </a>
                @endif
            @endfor

            {{-- Next --}}
            @if ($data->hasMorePages())
                <a href="{{ $data->nextPageUrl() }}{{ request()->getQueryString() ? '&'.request()->getQueryString() : '' }}"
                   class="px-3 py-2 bg-white border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50 flex items-center">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
            @else
                <span class="px-3 py-2 bg-gray-200 text-gray-400 rounded-lg text-sm cursor-not-allowed">
                    <i class="fa-solid fa-angle-right"></i>
                </span>
            @endif
        </div>

    </div>
@endif


    </div>
</x-app-layout>
