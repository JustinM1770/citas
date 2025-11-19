<x-app-layout>
    <x-slot name="header">
        Dashboard Administrador
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Usuarios</p>
                    <p class="text-3xl font-bold text-black mt-2">{{ $stats['total_usuarios'] }}</p>
                </div>
                <div class="bg-gray-light p-4 rounded-lg">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Profesionales</p>
                    <p class="text-3xl font-bold text-black mt-2">{{ $stats['total_profesionales'] }}</p>
                </div>
                <div class="bg-gray-light p-4 rounded-lg">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Servicios</p>
                    <p class="text-3xl font-bold text-black mt-2">{{ $stats['total_servicios'] }}</p>
                </div>
                <div class="bg-gray-light p-4 rounded-lg">
                    <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </x-card>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Citas</p>
                    <p class="text-3xl font-bold text-black mt-2">{{ $stats['total_citas'] }}</p>
                </div>
            </div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Citas Pendientes</p>
                    <p class="text-3xl font-bold text-black mt-2">{{ $stats['citas_pendientes'] }}</p>
                </div>
            </div>
        </x-card>

        <x-card>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Citas Hoy</p>
                    <p class="text-3xl font-bold text-black mt-2">{{ $stats['citas_hoy'] }}</p>
                </div>
            </div>
        </x-card>
    </div>

    <x-card title="Citas Recientes">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Cliente</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Profesional</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Servicio</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Fecha</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($citas_recientes as $cita)
                        <tr>
                            <td class="px-4 py-4 text-sm text-black">{{ $cita->user->name }}</td>
                            <td class="px-4 py-4 text-sm text-black">{{ $cita->profesional->user->name }}</td>
                            <td class="px-4 py-4 text-sm text-black">{{ $cita->servicio->nombre }}</td>
                            <td class="px-4 py-4 text-sm text-black">{{ $cita->fecha->format('d/m/Y') }} {{ $cita->hora->format('H:i') }}</td>
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
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">No hay citas registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
</x-app-layout>
