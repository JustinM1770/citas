<x-app-layout>
    <x-slot name="header">
        Gestión de Servicios
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('servicios.create') }}">
            <x-primary-button>
                Nuevo Servicio
            </x-primary-button>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($servicios as $servicio)
            <x-card>
                <div class="space-y-3">
                    <h3 class="text-xl font-bold text-black">{{ $servicio->nombre }}</h3>
                    <p class="text-gray-600 text-sm">{{ $servicio->descripcion }}</p>
                    
                    <div class="flex justify-between items-center border-t border-gray-200 pt-3">
                        <div>
                            <p class="text-sm text-gray-600">Duración</p>
                            <p class="font-semibold text-black">{{ $servicio->duracion }} min</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Precio</p>
                            <p class="font-semibold text-black text-xl">${{ number_format($servicio->precio, 2) }}</p>
                        </div>
                    </div>

                    <div class="flex gap-2 pt-2">
                        <a href="{{ route('servicios.edit', $servicio) }}" class="flex-1">
                            <x-secondary-button class="w-full justify-center">
                                Editar
                            </x-secondary-button>
                        </a>
                        
                        <form action="{{ route('servicios.destroy', $servicio) }}" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="w-full px-6 py-3 bg-red-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none transition ease-in-out duration-150"
                                onclick="return confirm('¿Eliminar servicio?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </x-card>
        @empty
            <div class="col-span-3">
                <x-card>
                    <p class="text-center text-gray-500 py-8">No hay servicios registrados</p>
                </x-card>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $servicios->links() }}
    </div>
</x-app-layout>
