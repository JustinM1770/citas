<x-app-layout>
    <x-slot name="header">
        Dashboard Profesional
    </x-slot>

    <div class="mb-8">
        <x-card title="Citas de Hoy">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Hora</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Cliente</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Servicio</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Duración</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($citas_hoy as $cita)
                            <tr>
                                <td class="px-4 py-4 text-sm font-semibold text-black">{{ $cita->hora->format('H:i') }}</td>
                                <td class="px-4 py-4 text-sm text-black">{{ $cita->user->name }}</td>
                                <td class="px-4 py-4 text-sm text-black">{{ $cita->servicio->nombre }}</td>
                                <td class="px-4 py-4 text-sm text-black">{{ $cita->servicio->duracion }} min</td>
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
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">No tienes citas para hoy</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>

    <x-card title="Próximas Citas">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Fecha</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Hora</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Cliente</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Servicio</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($proximas_citas as $cita)
                        <tr>
                            <td class="px-4 py-4 text-sm text-black">{{ $cita->fecha->format('d/m/Y') }}</td>
                            <td class="px-4 py-4 text-sm font-semibold text-black">{{ $cita->hora->format('H:i') }}</td>
                            <td class="px-4 py-4 text-sm text-black">{{ $cita->user->name }}</td>
                            <td class="px-4 py-4 text-sm text-black">{{ $cita->servicio->nombre }}</td>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">No tienes próximas citas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</x-app-layout>
