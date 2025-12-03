<x-app-layout>
    <div class="p-10 ml-15">

        <!-- Header + Back Button -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('users.index') }}"
               class="w-11 h-11 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-gray-200 transition">
                <i class="fa-solid fa-arrow-left text-gray-700"></i>
            </a>

            <h1 class="text-3xl font-bold text-gray-800">Tambah User</h1>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 max-w-3xl mx-auto">
            <div class="px-10 pt-10 pb-12">

                <form action="{{ route('users.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Nama -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-full px-5 py-3.5 border rounded-xl border-gray-300 focus:outline-none
                                          focus:ring-4 focus:ring-indigo-100"
                                   required>
                            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full px-5 py-3.5 border rounded-xl border-gray-300 focus:outline-none
                                          focus:ring-4 focus:ring-indigo-100"
                                   required>
                            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Password -->
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 font-semibold mb-2">Password <span class="text-red-500">*</span></label>
                            <input type="password" name="password"
                                   class="w-full px-5 py-3.5 border rounded-xl border-gray-300 focus:outline-none
                                          focus:ring-4 focus:ring-indigo-100"
                                   required>
                            @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end gap-4 pt-6 border-t border-gray-200">

                        <a href="{{ route('users.index') }}"
                           class="px-8 py-3.5 rounded-xl bg-gray-500 hover:bg-gray-600 text-white font-medium transition flex items-center gap-2">
                            Batal
                        </a>

                        <button type="submit"
                                class="px-10 py-3.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition
                                       flex items-center gap-3 shadow-lg hover:shadow-xl">
                            Simpan User
                        </button>

                    </div>

                </form>
            </div>
        </div>

    </div>
</x-app-layout>
