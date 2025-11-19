<x-app-layout>
    <x-slot name="header">
        Nuevo Horario
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route('horarios.store') }}" class="space-y-6" x-data="horarioForm()">
            @csrf

            @if(auth()->user()->isAdmin())
                <div>
                    <label for="profesional_id" class="block text-sm font-medium text-black mb-2">Profesional</label>
                    <select id="profesional_id" name="profesional_id" required
                        class="w-full rounded-lg border border-gray-300 focus:border-black focus:ring-black">
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
            @else
                <input type="hidden" name="profesional_id" value="{{ auth()->user()->profesional->id }}">
            @endif

            <div>
                <label class="block text-sm font-medium text-black mb-2">Días de la Semana</label>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="dias[]" value="lunes" 
                            class="rounded border-gray-300 text-black focus:ring-black"
                            {{ in_array('lunes', old('dias', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-black">Lunes</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="dias[]" value="martes" 
                            class="rounded border-gray-300 text-black focus:ring-black"
                            {{ in_array('martes', old('dias', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-black">Martes</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="dias[]" value="miercoles" 
                            class="rounded border-gray-300 text-black focus:ring-black"
                            {{ in_array('miercoles', old('dias', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-black">Miércoles</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="dias[]" value="jueves" 
                            class="rounded border-gray-300 text-black focus:ring-black"
                            {{ in_array('jueves', old('dias', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-black">Jueves</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="dias[]" value="viernes" 
                            class="rounded border-gray-300 text-black focus:ring-black"
                            {{ in_array('viernes', old('dias', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-black">Viernes</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="dias[]" value="sabado" 
                            class="rounded border-gray-300 text-black focus:ring-black"
                            {{ in_array('sabado', old('dias', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-black">Sábado</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="dias[]" value="domingo" 
                            class="rounded border-gray-300 text-black focus:ring-black"
                            {{ in_array('domingo', old('dias', [])) ? 'checked' : '' }}>
                        <span class="text-sm text-black">Domingo</span>
                    </label>
                </div>
                @error('dias')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="hora_inicio" class="block text-sm font-medium text-black mb-2">Hora de Inicio</label>
                    <input type="time" id="hora_inicio" name="hora_inicio" value="{{ old('hora_inicio') }}" required
                        class="w-full rounded-lg border border-gray-300 focus:border-black focus:ring-black">
                    @error('hora_inicio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="hora_fin" class="block text-sm font-medium text-black mb-2">Hora de Fin</label>
                    <input type="time" id="hora_fin" name="hora_fin" value="{{ old('hora_fin') }}" required
                        class="w-full rounded-lg border border-gray-300 focus:border-black focus:ring-black">
                    @error('hora_fin')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-sm text-gray-600">
                    <strong>Nota:</strong> Selecciona uno o varios días de la semana con el mismo horario. 
                    Se creará un horario para cada día seleccionado.
                </p>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>
                    Crear Horarios
                </x-primary-button>
                
                <a href="{{ route('horarios.index') }}">
                    <x-secondary-button type="button">
                        Cancelar
                    </x-secondary-button>
                </a>
            </div>
        </form>
    </x-card>

    <script>
        function horarioForm() {
            return {
                // Puedes agregar lógica adicional aquí si es necesario
            }
        }
    </script>
</x-app-layout>
