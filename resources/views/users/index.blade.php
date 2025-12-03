<x-app-layout>
    <div class="p-10 ml-15">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">User Management</h1>

            <a href="{{ route('users.create') }}"
               class="bg-indigo-600 text-white px-5 py-2.5 rounded-full font-medium hover:bg-indigo-700 transition flex items-center gap-2">
                <i class="fa-solid fa-user-plus"></i>
                Tambah User
            </a>
        </div>

        <!-- Table Card -->
        <div class="bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden">

            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 border-b">
                        <th class="py-3 px-6 text-sm">Nama</th>
                        <th class="py-3 px-6 text-sm">Email</th>
                        <th class="py-3 px-6 text-sm text-center w-40">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="py-3 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-9 w-9 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span>{{ $user->name }}</span>
                                </div>
                            </td>

                            <td class="py-3 px-6">{{ $user->email }}</td>

                            <td class="py-3 px-6">
                                <div class="flex items-center justify-center gap-3">

                                    <!-- Edit -->
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="px-4 py-1.5 border border-gray-400 rounded-lg text-gray-700 hover:bg-gray-100 transition">
                                        Edit
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                          onsubmit="return confirm('Hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-1.5 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
</x-app-layout>
