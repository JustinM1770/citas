<x-app-layout>
    <x-slot name="header">
        Gestión de Citas
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('citas.create') }}">
            <x-primary-button>
                Nueva Cita
            </x-primary-button>
        </a>
    </div>

    <x-card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        @if(auth()->user()->isAdmin())
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Cliente</th>
                        @endif
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Profesional</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Servicio</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Fecha</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Hora</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Estado</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($citas as $cita)
                        <tr>
                            @if(auth()->user()->isAdmin())
                                <td class="px-4 py-4 text-sm text-black">{{ $cita->user->name }}</td>
                            @endif
                            <td class="px-4 py-4 text-sm text-black">{{ $cita->profesional->user->name }}</td>
                            <td class="px-4 py-4 text-sm text-black">{{ $cita->servicio->nombre }}</td>
                            <td class="px-4 py-4 text-sm text-black">{{ $cita->fecha->format('d/m/Y') }}</td>
                            <td class="px-4 py-4 text-sm font-semibold text-black">{{ $cita->hora->format('H:i') }}</td>
                            <td class="px-4 py-4 text-sm">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($cita->estado === 'confirmada') bg-green-600 text-white
                                    @elseif($cita->estado === 'pendiente') bg-yellow-400 text-black
                                    @elseif($cita->estado === 'cancelada') bg-red-600 text-white
                                    @elseif($cita->estado === 'rechazada') bg-red-700 text-white
                                    @elseif($cita->estado === 'completada') bg-blue-600 text-white
                                    @else bg-gray-300 text-black
                                    @endif">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-sm space-x-2">
                                @can('update', $cita)
                                    <a href="{{ route('citas.edit', $cita) }}" class="text-black hover:underline">
                                        @if(auth()->user()->isProfesional())
                                            Gestionar
                                        @else
                                            Editar
                                        @endif
                                    </a>
                                @endcan
                                
                                @can('delete', $cita)
                                    <form action="{{ route('citas.destroy', $cita) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar cita?')">
                                            Eliminar
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">No hay citas registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $citas->links() }}
        </div>
    </x-card>
</x-app-layout>
