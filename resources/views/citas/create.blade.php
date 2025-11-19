<x-app-layout>
    <x-slot name="header">
        Nueva Cita
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route('citas.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="servicio_id" class="block text-sm font-medium text-black mb-2">Servicio</label>
                <select id="servicio_id" name="servicio_id" required
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                    <option value="">Seleccione un servicio</option>
                    @foreach($servicios as $servicio)
                        <option value="{{ $servicio->id }}" {{ old('servicio_id') == $servicio->id ? 'selected' : '' }}>
                            {{ $servicio->nombre }} - ${{ $servicio->precio }} ({{ $servicio->duracion }} min)
                        </option>
                    @endforeach
                </select>
                @error('servicio_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="profesional_id" class="block text-sm font-medium text-black mb-2">Profesional</label>
                <select id="profesional_id" name="profesional_id" required
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                    <option value="">Seleccione un profesional</option>
                    @foreach($profesionales as $profesional)
                        <option value="{{ $profesional->id }}" {{ old('profesional_id') == $profesional->id ? 'selected' : '' }}>
                            {{ $profesional->user->name }} - {{ $profesional->especialidad }}
                        </option>
                    @endforeach
                </select>
                @error('profesional_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="fecha" class="block text-sm font-medium text-black mb-2">Fecha</label>
                <input type="date" id="fecha" name="fecha" value="{{ old('fecha') }}" required
                    min="{{ date('Y-m-d') }}"
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                @error('fecha')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="hora" class="block text-sm font-medium text-black mb-2">Hora</label>
                <input type="time" id="hora" name="hora" value="{{ old('hora') }}" required
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                @error('hora')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>
                    Crear Cita
                </x-primary-button>
                
                <a href="{{ route('citas.index') }}">
                    <x-secondary-button type="button">
                        Cancelar
                    </x-secondary-button>
                </a>
            </div>
        </form>
    </x-card>
</x-app-layout>
