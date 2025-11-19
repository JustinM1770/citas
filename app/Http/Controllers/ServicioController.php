<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Http\Requests\StoreServicioRequest;
use App\Http\Requests\UpdateServicioRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ServicioController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny', Servicio::class);
        
        $servicios = Servicio::paginate(15);
        return view('servicios.index', compact('servicios'));
    }

    public function create()
    {
        $this->authorize('create', Servicio::class);
        
        return view('servicios.create');
    }

    public function store(StoreServicioRequest $request)
    {
        $validated = $request->validated();

        $servicio = Servicio::create($validated);

        // Log de auditoría
        Log::info('Servicio creado', [
            'servicio_id' => $servicio->id,
            'nombre' => $servicio->nombre,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio creado exitosamente.');
    }

    public function edit(Servicio $servicio)
    {
        $this->authorize('update', $servicio);
        
        return view('servicios.edit', compact('servicio'));
    }

    public function update(UpdateServicioRequest $request, Servicio $servicio)
    {
        $validated = $request->validated();

        $servicio->update($validated);

        // Log de auditoría
        Log::info('Servicio actualizado', [
            'servicio_id' => $servicio->id,
            'updated_by' => auth()->id(),
            'cambios' => $validated,
        ]);

        return redirect()->route('servicios.index')
            ->with('success', 'Servicio actualizado exitosamente.');
    }

    public function destroy(Servicio $servicio)
    {
        $this->authorize('delete', $servicio);

        // Log de auditoría
        Log::info('Servicio eliminado', [
            'servicio_id' => $servicio->id,
            'nombre' => $servicio->nombre,
            'deleted_by' => auth()->id(),
        ]);

        $servicio->delete();
        
        return redirect()->route('servicios.index')
            ->with('success', 'Servicio eliminado exitosamente.');
    }
}
