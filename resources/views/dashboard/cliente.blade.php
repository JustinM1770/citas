<x-app-layout>
    <x-slot name="header">
        Mis Citas
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('citas.create') }}">
            <x-primary-button>
                Agendar Nueva Cita
            </x-primary-button>
        </a>
    </div>

    <div class="mb-8">
        <x-card title="Próximas Citas">
            <div class="space-y-4">
                @forelse($proximas as $cita)
                    <div class="border-l-4 border-black pl-4 py-3 bg-gray-light rounded-r-lg">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-semibold text-black text-lg">{{ $cita->servicio->nombre }}</p>
                                <p class="text-gray-600 mt-1">{{ $cita->profesional->user->name }} - {{ $cita->profesional->especialidad }}</p>
                                <p class="text-black font-medium mt-2">{{ $cita->fecha->format('d/m/Y') }} a las {{ $cita->hora->format('H:i') }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($cita->estado === 'confirmada') bg-green-600 text-white
                                @elseif($cita->estado === 'pendiente') bg-yellow-400 text-black
                                @elseif($cita->estado === 'cancelada') bg-red-600 text-white
                                @elseif($cita->estado === 'rechazada') bg-red-700 text-white
                                @else bg-gray-300 text-black
                                @endif">
                                {{ ucfirst($cita->estado) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-8">No tienes citas próximas</p>
                @endforelse
            </div>
        </x-card>
    </div>

    <x-card title="Historial de Citas">
        <div class="space-y-4">
            @forelse($historial as $cita)
                <div class="border-l-4 border-gray-300 pl-4 py-3 bg-gray-50 rounded-r-lg">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-semibold text-black">{{ $cita->servicio->nombre }}</p>
                            <p class="text-gray-600 text-sm mt-1">{{ $cita->profesional->user->name }}</p>
                            <p class="text-gray-700 text-sm mt-1">{{ $cita->fecha->format('d/m/Y') }} - {{ $cita->hora->format('H:i') }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($cita->estado === 'completada') bg-blue-600 text-white
                            @elseif($cita->estado === 'cancelada') bg-red-600 text-white
                            @elseif($cita->estado === 'rechazada') bg-red-700 text-white
                            @elseif($cita->estado === 'confirmada') bg-green-600 text-white
                            @elseif($cita->estado === 'pendiente') bg-yellow-400 text-black
                            @else bg-gray-300 text-black
                            @endif">
                            {{ ucfirst($cita->estado) }}
                        </span>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 py-8">No tienes historial de citas</p>
            @endforelse
        </div>
    </x-card>
</x-app-layout>
