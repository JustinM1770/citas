<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-light text-black text-center">Crear Cuenta</h2>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-light text-black mb-2">Nombre</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-black focus:ring-black focus:outline-none transition">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="block text-sm font-light text-black mb-2">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-black focus:ring-black focus:outline-none transition">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-sm font-light text-black mb-2">Contraseña</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-black focus:ring-black focus:outline-none transition">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-light text-black mb-2">Confirmar Contraseña</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:border-black focus:ring-black focus:outline-none transition">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="space-y-4">
            <x-primary-button class="w-full justify-center">
                Registrarse
            </x-primary-button>

            <div class="text-center">
                <a href="{{ route('login') }}" class="text-sm text-black hover:underline">
                    ¿Ya tienes cuenta? Inicia sesión
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
