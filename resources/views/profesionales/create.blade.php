<x-app-layout>
    <x-slot name="header">
        Nuevo Profesional
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route('profesionales.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-black mb-2">Nombre Completo</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-black mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-black mb-2">Contraseña</label>
                <input type="password" id="password" name="password" required
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="especialidad" class="block text-sm font-medium text-black mb-2">Especialidad</label>
                <input type="text" id="especialidad" name="especialidad" value="{{ old('especialidad') }}" required
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                @error('especialidad')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="telefono" class="block text-sm font-medium text-black mb-2">Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}"
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                @error('telefono')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="descripcion" class="block text-sm font-medium text-black mb-2">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4"
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>
                    Crear Profesional
                </x-primary-button>
                
                <a href="{{ route('profesionales.index') }}">
                    <x-secondary-button type="button">
                        Cancelar
                    </x-secondary-button>
                </a>
            </div>
        </form>
    </x-card>
</x-app-layout>
