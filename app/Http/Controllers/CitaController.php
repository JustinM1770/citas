<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Profesional;
use App\Models\Servicio;
use App\Models\Horario;
use App\Http\Requests\StoreCitaRequest;
use App\Http\Requests\UpdateCitaRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Auth\Access\AuthorizationException;
use App\Mail\CitaCreada;
use App\Mail\CitaCancelada;

class CitaController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny', Cita::class);
        
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            $citas = Cita::with(['user', 'profesional.user', 'servicio'])->latest()->paginate(15);
        } elseif ($user->isProfesional()) {
            $citas = Cita::where('profesional_id', $user->profesional->id)
                ->with(['user', 'servicio'])
                ->latest()
                ->paginate(15);
        } else {
            $citas = Cita::where('user_id', $user->id)
                ->with(['profesional.user', 'servicio'])
                ->latest()
                ->paginate(15);
        }

        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $this->authorize('create', Cita::class);
        
        $servicios = Servicio::all();
        $profesionales = Profesional::with('user')->get();
        
        return view('citas.create', compact('servicios', 'profesionales'));
    }

    public function store(StoreCitaRequest $request)
    {
        $validated = $request->validated();

        $cita = Cita::create([
            'user_id' => auth()->id(),
            'servicio_id' => $validated['servicio_id'],
            'profesional_id' => $validated['profesional_id'],
            'fecha' => $validated['fecha'],
            'hora' => $validated['hora'],
            'estado' => 'pendiente',
            'notas' => $validated['notas'] ?? null,
        ]);

        // Log de auditoría
        Log::info('Cita creada', [
            'cita_id' => $cita->id,
            'user_id' => auth()->id(),
            'profesional_id' => $cita->profesional_id,
            'fecha' => $cita->fecha,
            'hora' => $cita->hora,
        ]);

        // Enviar correo (opcional)
        try {
            // Mail::to($cita->user->email)->send(new CitaCreada($cita));
        } catch (\Exception $e) {
            Log::warning('Error al enviar email de cita creada', ['error' => $e->getMessage()]);
        }

        return redirect()->route('citas.index')
            ->with('success', 'Cita creada exitosamente.');
    }

    public function edit(Cita $cita)
    {
        $this->authorize('update', $cita);

        $servicios = Servicio::all();
        $profesionales = Profesional::with('user')->get();
        
        return view('citas.edit', compact('cita', 'servicios', 'profesionales'));
    }

    public function update(UpdateCitaRequest $request, Cita $cita)
    {
        $validated = $request->validated();

        $estadoAnterior = $cita->estado;
        $cita->update($validated);

        // Log de auditoría
        Log::info('Cita actualizada', [
            'cita_id' => $cita->id,
            'user_id' => auth()->id(),
            'estado_anterior' => $estadoAnterior,
            'estado_nuevo' => $cita->estado,
        ]);

        if (isset($validated['estado']) && $validated['estado'] === 'cancelada') {
            try {
                // Mail::to($cita->user->email)->send(new CitaCancelada($cita));
            } catch (\Exception $e) {
                Log::warning('Error al enviar email de cita cancelada', ['error' => $e->getMessage()]);
            }
        }

        return redirect()->route('citas.index')
            ->with('success', 'Cita actualizada exitosamente.');
    }

    public function destroy(Cita $cita)
    {
        try {
            $this->authorize('delete', $cita);
        } catch (AuthorizationException $e) {
            return redirect()->route('citas.index')
                ->with('error', $e->getMessage());
        }

        // Log de auditoría
        Log::info('Cita eliminada', [
            'cita_id' => $cita->id,
            'user_id' => auth()->id(),
            'profesional_id' => $cita->profesional_id,
            'fecha' => $cita->fecha,
        ]);

        $cita->delete();

        return redirect()->route('citas.index')
            ->with('success', 'Cita eliminada exitosamente.');
    }
}
