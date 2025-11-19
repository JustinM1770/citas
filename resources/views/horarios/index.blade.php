<x-app-layout>
    <x-slot name="header">
        Gestión de Horarios
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('horarios.create') }}">
            <x-primary-button>
                Nuevo Horario
            </x-primary-button>
        </a>
    </div>

    <x-card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        @if(auth()->user()->isAdmin())
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Profesional</th>
                        @endif
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Día</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Hora Inicio</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Hora Fin</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Estado</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($horarios as $horario)
                        <tr class="{{ !$horario->disponible ? 'bg-gray-50' : '' }}">
                            @if(auth()->user()->isAdmin())
                                <td class="px-4 py-4 text-sm font-semibold text-black">{{ $horario->profesional->user->name }}</td>
                            @endif
                            <td class="px-4 py-4 text-sm text-black">{{ ucfirst($horario->dia_semana) }}</td>
                            <td class="px-4 py-4 text-sm text-black">{{ $horario->hora_inicio->format('H:i') }}</td>
                            <td class="px-4 py-4 text-sm text-black">{{ $horario->hora_fin->format('H:i') }}</td>
                            <td class="px-4 py-4 text-sm">
                                <form action="{{ route('horarios.toggle', $horario) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                        class="px-3 py-1 rounded-full text-xs font-semibold transition-colors
                                        {{ $horario->disponible 
                                            ? 'bg-green-600 text-white hover:bg-green-700' 
                                            : 'bg-red-600 text-white hover:bg-red-700' }}">
                                        {{ $horario->disponible ? 'Disponible' : 'No Disponible' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-4 text-sm">
                                <form action="{{ route('horarios.destroy', $horario) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar horario?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->isAdmin() ? '6' : '5' }}" class="px-4 py-8 text-center text-gray-500">
                                No hay horarios registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</x-app-layout>
