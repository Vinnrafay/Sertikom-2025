<x-app-layout>
    <div class="p-4 sm:p-6 md:p-8 lg:ml-15">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
                Dashboard Admin
            </h1>

            <a href="{{ route('siswa.index') }}"
               class="bg-indigo-600 text-white px-5 py-2.5 rounded-full font-semibold 
                      hover:bg-indigo-700 transition flex items-center justify-center gap-2 shadow w-full sm:w-auto">
                <i class="fa-solid fa-users text-sm"></i>
                Lihat Data Siswa
            </a>
        </div>

        <!-- Card Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

            <!-- Total Siswa -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Siswa</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalSiswa }}</h3>
                </div>
                <i class="fa-solid fa-users text-indigo-600 text-3xl"></i>
            </div>

            <!-- Total Kelas -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Kelas</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalKelas }}</h3>
                </div>
                <i class="fa-solid fa-school text-indigo-600 text-3xl"></i>
            </div>

            <!-- Total Jurusan -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Jurusan</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalJurusan }}</h3>
                </div>
                <i class="fa-solid fa-graduation-cap text-indigo-600 text-3xl"></i>
            </div>

            <!-- Total Tahun Ajar -->
            <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Tahun Ajar</p>
                    <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalTahun }}</h3>
                </div>
                <i class="fa-solid fa-calendar text-indigo-600 text-3xl"></i>
            </div>

        </div>

        <!-- Siswa Terbaru -->
        <div class="mt-12 bg-white p-6 rounded-xl border border-gray-200 shadow-sm">

            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-4">
                <h2 class="text-xl font-semibold text-gray-800">Siswa Terbaru</h2>

                <div class="relative w-full sm:w-64">
                    <input type="text"
                           placeholder="Cari siswa..."
                           class="border border-gray-300 rounded-lg py-2 px-4 w-full text-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <i class="fa-solid fa-magnifying-glass absolute right-3 top-3 text-gray-400 text-sm"></i>
                </div>
            </div>

            <!-- Table Responsive Wrapper -->
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full text-left min-w-[600px]">

                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50">
                            <th class="py-3 px-4 text-gray-600 text-sm">Nama Siswa</th>
                            <th class="py-3 px-4 text-gray-600 text-sm">NISN</th>
                            <th class="py-3 px-4 text-gray-600 text-sm">Kelas</th>
                            <th class="py-3 px-4 text-gray-600 text-sm">Jurusan</th>
                            <th class="py-3 px-4 text-gray-600 text-sm text-center w-32">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($siswaBaru as $siswa)
                            <tr class="border-b hover:bg-gray-50 transition">

                                <td class="py-3 px-4">{{ $siswa->nama_lengkap }}</td>

                                <td class="py-3 px-4">{{ $siswa->nisn }}</td>

                                <td class="py-3 px-4">
                                    {{ $siswa->kelasAktif->kelas->nama_kelas ?? '-' }}
                                </td>

                                <td class="py-3 px-4">
                                    {{ $siswa->kelasAktif->kelas->jurusan->nama_jurusan ?? '-' }}
                                </td>

                                <td class="py-3 px-4 text-center">
                                    <div class="flex items-center justify-center gap-4">

                                        <!-- Detail -->
                                        <a href="{{ route('siswa.show', $siswa->id) }}"
                                           class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold">
                                            Detail
                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('siswa.edit', $siswa->id) }}"
                                           class="text-yellow-600 hover:text-yellow-800 text-sm font-semibold">
                                            Edit
                                        </a>

                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

    </div>
</x-app-layout>
