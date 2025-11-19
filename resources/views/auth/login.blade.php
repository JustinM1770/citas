<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-light text-black text-center">Iniciar Sesión</h2>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-light text-black mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-black focus:ring-black focus:outline-none transition">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-sm font-light text-black mb-2">Contraseña</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-black focus:ring-black focus:outline-none transition">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember"
                class="rounded border-gray-300 text-black focus:ring-black">
            <label for="remember_me" class="ml-2 text-sm text-gray-700">Recordarme</label>
        </div>

        <div class="space-y-4">
            <x-primary-button class="w-full justify-center">
                Iniciar Sesión
            </x-primary-button>

            <div class="text-center">
                <a href="{{ route('register') }}" class="text-sm text-black hover:underline">
                    ¿No tienes cuenta? Regístrate
                </a>
            </div>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:underline">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>
            @endif
        </div>
    </form>
</x-guest-layout>
