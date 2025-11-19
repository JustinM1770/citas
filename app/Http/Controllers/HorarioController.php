<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Profesional;
use App\Http\Requests\StoreHorarioRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class HorarioController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny', Horario::class);
        
        $user = auth()->user();
        
        if ($user->isProfesional()) {
            $horarios = Horario::where('profesional_id', $user->profesional->id)
                ->orderBy('dia_semana')
                ->orderBy('hora_inicio')
                ->get();
        } else {
            $horarios = Horario::with('profesional.user')
                ->orderBy('profesional_id')
                ->orderBy('dia_semana')
                ->orderBy('hora_inicio')
                ->get();
        }

        return view('horarios.index', compact('horarios'));
    }

    public function create()
    {
        $this->authorize('create', Horario::class);
        
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            $profesionales = Profesional::with('user')->get();
        } else {
            $profesionales = collect([$user->profesional]);
        }
        
        return view('horarios.create', compact('profesionales'));
    }

    public function store(StoreHorarioRequest $request)
    {
        $validated = $request->validated();
        
        $dias = $validated['dias'];
        unset($validated['dias']);
        
        $horariosCreados = [];
        
        // Crear un horario para cada día seleccionado
        foreach ($dias as $dia) {
            $horario = Horario::create([
                'profesional_id' => $validated['profesional_id'],
                'dia_semana' => $dia,
                'hora_inicio' => $validated['hora_inicio'],
                'hora_fin' => $validated['hora_fin'],
                'disponible' => $validated['disponible'] ?? true,
            ]);
            
            $horariosCreados[] = $horario->id;
            
            // Log de auditoría
            Log::info('Horario creado', [
                'horario_id' => $horario->id,
                'profesional_id' => $horario->profesional_id,
                'dia_semana' => $horario->dia_semana,
                'created_by' => auth()->id(),
            ]);
        }

        $mensaje = count($horariosCreados) === 1 
            ? 'Horario creado exitosamente.' 
            : count($horariosCreados) . ' horarios creados exitosamente.';

        return redirect()->route('horarios.index')
            ->with('success', $mensaje);
    }

    public function toggle(Horario $horario)
    {
        $this->authorize('update', $horario);

        $horario->disponible = !$horario->disponible;
        $horario->save();

        // Log de auditoría
        Log::info('Horario disponibilidad cambiada', [
            'horario_id' => $horario->id,
            'profesional_id' => $horario->profesional_id,
            'disponible' => $horario->disponible,
            'changed_by' => auth()->id(),
        ]);

        $mensaje = $horario->disponible 
            ? 'Horario marcado como disponible.' 
            : 'Horario marcado como no disponible.';

        return redirect()->route('horarios.index')
            ->with('success', $mensaje);
    }

    public function destroy(Horario $horario)
    {
        $this->authorize('delete', $horario);

        // Log de auditoría
        Log::info('Horario eliminado', [
            'horario_id' => $horario->id,
            'profesional_id' => $horario->profesional_id,
            'deleted_by' => auth()->id(),
        ]);

        $horario->delete();
        
        return redirect()->route('horarios.index')
            ->with('success', 'Horario eliminado exitosamente.');
    }
}
