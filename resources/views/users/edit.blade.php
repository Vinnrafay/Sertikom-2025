<x-app-layout>
    <div class="p-10 ml-15">

        <!-- Header + Back -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('users.index') }}"
               class="w-11 h-11 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-gray-200 transition">
                <i class="fa-solid fa-arrow-left text-gray-700"></i>
            </a>

            <h1 class="text-3xl font-bold text-gray-800">Edit User</h1>
        </div>

        <!-- Card -->
        <div class="bg-white shadow-lg border border-gray-200 rounded-2xl max-w-xl mx-auto">
            <div class="px-10 py-10">

                <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <label class="block font-semibold mb-2 text-gray-700">Nama</label>
                        <input type="text" 
                               name="name" 
                               value="{{ $user->name }}" 
                               required
                               class="w-full px-5 py-3.5 border border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:outline-none">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block font-semibold mb-2 text-gray-700">Email</label>
                        <input type="email" 
                               name="email" 
                               value="{{ $user->email }}" 
                               required
                               class="w-full px-5 py-3.5 border border-gray-300 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:outline-none">
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-4 pt-4 border-t border-gray-200">
                        <a href="{{ route('users.index') }}"
                           class="px-8 py-3 rounded-xl bg-gray-500 text-white hover:bg-gray-600 transition font-medium">
                            Batal
                        </a>

                        <button type="submit"
                            class="px-10 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold shadow-lg hover:shadow-xl transition">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</x-app-layout>
