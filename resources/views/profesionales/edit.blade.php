<x-app-layout>
    <x-slot name="header">
        Editar Profesional
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route('profesionales.update', $profesionale) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-black mb-2">Nombre Completo</label>
                <input type="text" id="name" name="name" value="{{ old('name', $profesionale->user->name) }}" required
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-black mb-2">Email</label>
                <p class="text-gray-600">{{ $profesionale->user->email }}</p>
            </div>

            <div>
                <label for="especialidad" class="block text-sm font-medium text-black mb-2">Especialidad</label>
                <input type="text" id="especialidad" name="especialidad" value="{{ old('especialidad', $profesionale->especialidad) }}" required
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                @error('especialidad')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="telefono" class="block text-sm font-medium text-black mb-2">Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $profesionale->telefono) }}"
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                @error('telefono')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="descripcion" class="block text-sm font-medium text-black mb-2">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4"
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">{{ old('descripcion', $profesionale->descripcion) }}</textarea>
                @error('descripcion')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>
                    Actualizar
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
