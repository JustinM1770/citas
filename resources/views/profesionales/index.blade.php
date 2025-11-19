<x-app-layout>
    <x-slot name="header">
        Gestión de Profesionales
    </x-slot>

    <div class="mb-6">
        <a href="{{ route('profesionales.create') }}">
            <x-primary-button>
                Nuevo Profesional
            </x-primary-button>
        </a>
    </div>

    <x-card>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Especialidad</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Teléfono</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($profesionales as $profesional)
                        <tr>
                            <td class="px-4 py-4 text-sm font-semibold text-black">{{ $profesional->user->name }}</td>
                            <td class="px-4 py-4 text-sm text-black">{{ $profesional->user->email }}</td>
                            <td class="px-4 py-4 text-sm text-black">{{ $profesional->especialidad }}</td>
                            <td class="px-4 py-4 text-sm text-black">{{ $profesional->telefono }}</td>
                            <td class="px-4 py-4 text-sm space-x-2">
                                <a href="{{ route('profesionales.edit', $profesional) }}" class="text-black hover:underline">Editar</a>
                                
                                <form action="{{ route('profesionales.destroy', $profesional) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('¿Eliminar profesional?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">No hay profesionales registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $profesionales->links() }}
        </div>
    </x-card>
</x-app-layout>
