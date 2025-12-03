<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-gray-200 p-8">

        <!-- Header -->
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-1">
            Login Admin
        </h1>
        <p class="text-center text-gray-500 text-sm mb-6">
            Silakan masuk untuk mengakses dashboard.
        </p>

        <!-- Status -->
        @if (session('status'))
            <div class="mb-4 text-green-600 text-center text-sm font-medium">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label class="block mb-1 text-gray-700 font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 border rounded-xl focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="block mb-1 text-gray-700 font-medium">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 border rounded-xl focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Remember + Forgot -->
            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember"
                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span class="text-gray-700 text-sm">Ingat saya</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-indigo-600 hover:underline">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition shadow">
                Login
            </button>

        </form>

    </div>

</body>
</html>
