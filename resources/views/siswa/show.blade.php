<x-app-layout>
    <div class="p-10 ml-15">

        {{-- notif ini yh --}}
    @if (session('success') || session('error') || session('info'))
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 3000)"
            class="mb-6"
        >
            @if (session('success'))
                <div class="px-5 py-4 bg-green-100 border border-green-300 text-green-700 rounded-xl">
                    <strong class="font-semibold">Berhasil:</strong> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="px-5 py-4 bg-red-100 border border-red-300 text-red-700 rounded-xl">
                    <strong class="font-semibold">Error:</strong> {{ session('error') }}
                </div>
            @endif

            @if (session('info'))
                <div class="px-5 py-4 bg-blue-100 border border-blue-300 text-blue-700 rounded-xl">
                    <strong class="font-semibold">Info:</strong> {{ session('info') }}
                </div>
            @endif
        </div>
    @endif

        <!-- Back -->
        <a href="{{ route('siswa.index') }}"
            class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-800 mb-6">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                Detail Siswa
            </h1>

            <a href="{{ route('siswa.edit', $siswa) }}"
                class="px-5 py-2 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700">
                Edit Data
            </a>
        </div>

        <!-- MAIN CARD -->
        <div class="bg-white shadow border rounded-2xl p-8">

            <!-- BIODATA -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Biodata Siswa</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <p class="text-gray-500">Kode Siswa</p>
                    <p class="font-semibold text-gray-800">{{ $siswa->kode_siswa }}</p>
                </div>

                <div>
                    <p class="text-gray-500">NISN</p>
                    <p class="font-semibold text-gray-800">{{ $siswa->nisn }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Nama Lengkap</p>
                    <p class="font-semibold text-gray-800">{{ $siswa->nama_lengkap }}</p>
                </div>

                <div>
                    <p class="text-gray-500">Jenis Kelamin</p>
                    <p class="font-semibold text-gray-800">
                        {{ $siswa->jenis_kelamin == "L" ? "Laki-laki" : "Perempuan" }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">Tempat, Tanggal Lahir</p>
                    <p class="font-semibold text-gray-800">
                        {{ $siswa->tempat_lahir }},
                        {{ $siswa->tanggal_lahir->format('d M Y') }}
                    </p>
                </div>

                <div>
                    <p class="text-gray-500">No. Telepon</p>
                    <p class="font-semibold text-gray-800">
                        {{ $siswa->no_telepon ?? '-' }}
                    </p>
                </div>

                <div class="md:col-span-2">
                    <p class="text-gray-500">Alamat</p>
                    <p class="font-semibold text-gray-800">{{ $siswa->alamat ?? '-' }}</p>
                </div>

            </div>

            <hr class="my-10">

            <!-- KELAS AKTIF -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Kelas Saat Ini</h2>

            @if ($siswa->kelasAktif)
                <div class="p-5 bg-indigo-50 border border-indigo-200 rounded-xl flex justify-between items-center">

                    <div>
                        <p class="text-gray-600 text-sm">Kelas Aktif</p>
                        <p class="font-bold text-indigo-700 text-xl">
                            {{ $siswa->kelasAktif->kelas->level_kelas }}
                            {{ $siswa->kelasAktif->kelas->nama_kelas }}
                        </p>
                        <p class="text-gray-600 text-sm">
                            Tahun Ajar: {{ $siswa->kelasAktif->tahunAjar->nama_tahun_ajar }}
                        </p>
                    </div>

                </div>
            @else
                <p class="text-gray-500 italic">Belum memiliki kelas aktif.</p>
            @endif

            <hr class="my-10">

            <!-- FORM UPDATE KELAS -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Update Kelas & Tahun Ajar</h2>

            <form action="{{ route('siswa.updateKelas', $siswa) }}" method="POST"
                  class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6 bg-gray-50 border rounded-xl">
                @csrf

                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Kelas</label>
                    <select name="kelas_id" class="w-full px-4 py-3 border rounded-xl">
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id }}"
                                {{ $siswa->kelasAktif && $siswa->kelasAktif->kelas_id == $k->id ? 'selected' : '' }}>
                                {{ $k->level_kelas }} {{ $k->nama_kelas }} - {{ $k->jurusan->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 mb-2 font-medium">Tahun Ajar</label>
                    <select name="tahun_ajar_id" class="w-full px-4 py-3 border rounded-xl">
                        @foreach ($tahunAjar as $ta)
                            <option value="{{ $ta->id }}"
                                {{ $siswa->kelasAktif && $siswa->kelasAktif->tahun_ajar_id == $ta->id ? 'selected' : '' }}>
                                {{ $ta->nama_tahun_ajar }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 font-semibold shadow">
                        Update
                    </button>
                </div>

            </form>

            <hr class="my-10">

            <!-- RIWAYAT KELAS -->
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Riwayat Kelas</h2>

            <div class="overflow-hidden border rounded-xl">

                <table class="w-full text-left">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="py-3 px-4 text-sm font-semibold">Kelas</th>
                            <th class="py-3 px-4 text-sm font-semibold">Tahun Ajar</th>
                            <th class="py-3 px-4 text-sm font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayat as $r)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    {{ $r->kelas->level_kelas }} {{ $r->kelas->nama_kelas }}
                                </td>
                                <td class="py-3 px-4">
                                    {{ $r->tahunAjar->nama_tahun_ajar }}
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-3 py-1 rounded-full text-xs
                                        {{ $r->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                                        {{ ucfirst($r->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            <div class="mt-4">
                {{ $riwayat->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
