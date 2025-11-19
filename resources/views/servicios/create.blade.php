<x-app-layout>
    <x-slot name="header">
        Nuevo Servicio
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route('servicios.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="nombre" class="block text-sm font-medium text-black mb-2">Nombre del Servicio</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                @error('nombre')
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="duracion" class="block text-sm font-medium text-black mb-2">Duración (minutos)</label>
                    <input type="number" id="duracion" name="duracion" value="{{ old('duracion') }}" required min="1"
                        class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                    @error('duracion')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="precio" class="block text-sm font-medium text-black mb-2">Precio</label>
                    <input type="number" id="precio" name="precio" value="{{ old('precio') }}" required min="0" step="0.01"
                        class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                    @error('precio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>
                    Crear Servicio
                </x-primary-button>
                
                <a href="{{ route('servicios.index') }}">
                    <x-secondary-button type="button">
                        Cancelar
                    </x-secondary-button>
                </a>
            </div>
        </form>
    </x-card>
</x-app-layout>
