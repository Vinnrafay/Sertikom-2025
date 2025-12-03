<nav 
    x-data="{ open: false }"
    class="relative z-50"
>

    <!-- MOBILE TOGGLE BUTTON -->
    <button 
        @click="open = !open"
        class="lg:hidden fixed top-4 left-4 z-50 bg-white border p-2 rounded-lg shadow"
    >
        <i class="fa-solid fa-bars text-xl"></i>
    </button>

    <!-- OVERLAY (mobile only) -->
    <div 
        x-show="open" 
        @click="open = false"
        class="fixed inset-0 bg-black bg-opacity-40 lg:hidden"
    ></div>

    <!-- SIDEBAR -->
    <aside 
        :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed top-0 left-0 h-screen w-64 bg-white shadow-lg border-r border-gray-100 
               flex flex-col transform transition-all duration-300 lg:translate-x-0 lg:static"
    >

        <!-- Logo -->
        <div class="flex items-center justify-center h-20 border-b border-gray-100">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                <span class="font-extrabold text-xl text-gray-800 tracking-wide">Sekolah <b>Kesatuan</b></span>
            </a>
        </div>

        <!-- Profile Section -->
        <div class="px-4 mt-6">
            @auth
                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-lg font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="font-semibold text-gray-800 text-sm">{{ Auth::user()->name }}</span>
                        <span class="text-gray-500 text-xs capitalize">{{ Auth::user()->role ?? 'Admin' }}</span>
                    </div>
                </div>
            @else
                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    <div class="h-10 w-10 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center">
                        <i class="fa-solid fa-user-slash text-lg"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-semibold text-gray-800 text-sm">Guest</span>
                        <span class="text-gray-500 text-xs">Not logged in</span>
                    </div>
                </div>
            @endauth
        </div>

        <!-- Menu -->
        <div class="mt-6 px-4 space-y-6 flex-1 overflow-y-auto">

            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 px-4">Main</p>

            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-3 rounded-xl transition
                       hover:bg-indigo-50 hover:text-indigo-600 group
                       {{ request()->routeIs('dashboard') ? 'bg-indigo-100 text-indigo-600 font-semibold shadow-sm' : 'text-gray-700' }}">
                <i class="fa-solid fa-house mr-3 text-lg opacity-80 group-hover:opacity-100"></i>
                Dashboard
            </a>

            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 px-4">Master Data</p>

            <a href="{{ route('tahunajar.index') }}" 
                class="flex items-center px-4 py-3 rounded-xl transition 
                       hover:bg-indigo-50 hover:text-indigo-600 group
                       {{ request()->routeIs('tahunajar.*') ? 'bg-indigo-100 text-indigo-600 font-semibold shadow-sm' : 'text-gray-700' }}">
                <i class="fa-solid fa-calendar-days mr-3 text-lg opacity-80 group-hover:opacity-100"></i>
                Tahun Ajar
            </a>

            <a href="{{ route('jurusan.index') }}"
                class="flex items-center px-4 py-3 rounded-xl transition
                       hover:bg-indigo-50 hover:text-indigo-600 group
                       {{ request()->routeIs('jurusan.*') ? 'bg-indigo-100 text-indigo-600 font-semibold shadow-sm' : 'text-gray-700' }}">
                <i class="fa-solid fa-graduation-cap mr-3 text-lg opacity-80 group-hover:opacity-100"></i>
                Jurusan
            </a>

            <a href="{{ route('kelas.index') }}"
                class="flex items-center px-4 py-3 rounded-xl transition
                       hover:bg-indigo-50 hover:text-indigo-600 group
                       {{ request()->routeIs('kelas.*') ? 'bg-indigo-100 text-indigo-600 font-semibold shadow-sm' : 'text-gray-700' }}">
                <i class="fa-solid fa-school mr-3 text-lg opacity-80 group-hover:opacity-100"></i>
                Kelas
            </a>

            <a href="{{ route('siswa.index') }}"
                class="flex items-center px-4 py-3 rounded-xl transition
                       hover:bg-indigo-50 hover:text-indigo-600 group
                       {{ request()->routeIs('siswa.*') ? 'bg-indigo-100 text-indigo-600 font-semibold shadow-sm' : 'text-gray-700' }}">
                <i class="fa-solid fa-user-graduate mr-3 text-lg opacity-80 group-hover:opacity-100"></i>
                Data Siswa
            </a>

            <a href="{{ route('users.index') }}"
                class="flex items-center px-4 py-3 rounded-xl transition
                       hover:bg-indigo-50 hover:text-indigo-600 group
                       {{ request()->routeIs('users.*') ? 'bg-indigo-100 text-indigo-600 font-semibold shadow-sm' : 'text-gray-700' }}">
                <i class="fa-solid fa-users mr-3 text-lg opacity-80 group-hover:opacity-100"></i>
                User Management
            </a>

        </div>

        <!-- Logout -->
        <div class="px-4 mb-6 border-t border-gray-100 pt-5">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center px-4 py-3 w-full rounded-xl text-gray-700 hover:bg-red-50 hover:text-red-600 
                               transition font-medium">
                        <i class="fa-solid fa-right-from-bracket mr-3 text-lg"></i>
                        Log Out
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="flex items-center px-4 py-3 w-full rounded-xl text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 
                           transition">
                    <i class="fa-solid fa-right-to-bracket mr-3 text-lg"></i>
                    Login
                </a>
            @endauth
        </div>

    </aside>

</nav>
