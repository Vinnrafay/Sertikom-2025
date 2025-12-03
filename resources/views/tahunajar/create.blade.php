<x-app-layout>
    <div class="p-10 ml-15">

        <!-- Back Button + Title -->
        <div class="flex items-center gap-3 mb-10">
            <a href="{{ route('tahunajar.index') }}"
               class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 transition">
                <i class="fa-solid fa-arrow-left text-gray-700"></i>
            </a>

            <h1 class="text-3xl font-bold text-gray-800">Menambah Tahun Ajar Baru</h1>
        </div>


        <!-- CARD FORM -->
        <div class="bg-white p-10 rounded-2xl shadow-xl max-w-3xl mx-auto border border-gray-100">

            <h2 class="text-2xl font-bold mb-8">Tahun Ajar</h2>

            <form action="{{ route('tahunajar.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-1">Kode Tahun</label>
                    <input type="text" name="kode_tahun_ajar"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 font-semibold mb-1">Nama Tahun Ajar</label>
                    <input type="text" name="nama_tahun_ajar"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <button type="submit"
                        class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                    Submit
                    <i class="fa-solid fa-arrow-right"></i>
                </button>

            </form>

        </div>

    </div>
</x-app-layout>
