<x-app-layout>
    <x-slot name="header">
        Editar Cita
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route('citas.update', $cita) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-gray-light p-4 rounded-lg">
                <h3 class="font-semibold text-black mb-2">Información de la Cita</h3>
                <p class="text-sm text-gray-700"><strong>Cliente:</strong> {{ $cita->user->name }}</p>
                <p class="text-sm text-gray-700"><strong>Profesional:</strong> {{ $cita->profesional->user->name }}</p>
                <p class="text-sm text-gray-700"><strong>Servicio:</strong> {{ $cita->servicio->nombre }}</p>
                <p class="text-sm text-gray-700"><strong>Fecha:</strong> {{ $cita->fecha->format('d/m/Y') }}</p>
                <p class="text-sm text-gray-700"><strong>Hora:</strong> {{ $cita->hora->format('H:i') }}</p>
            </div>

            <div>
                <label for="estado" class="block text-sm font-medium text-black mb-2">Estado</label>
                <select id="estado" name="estado" required
                    class="w-full rounded-lg border-2 border-gray-300 focus:border-black focus:ring-black">
                    <option value="pendiente" {{ $cita->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="confirmada" {{ $cita->estado === 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                    <option value="cancelada" {{ $cita->estado === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    <option value="completada" {{ $cita->estado === 'completada' ? 'selected' : '' }}>Completada</option>
                </select>
                @error('estado')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>
                    Actualizar Estado
                </x-primary-button>
                
                <a href="{{ route('citas.index') }}">
                    <x-secondary-button type="button">
                        Volver
                    </x-secondary-button>
                </a>
            </div>
        </form>
    </x-card>
</x-app-layout>
