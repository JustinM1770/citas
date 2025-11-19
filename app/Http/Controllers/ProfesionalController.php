<?php

namespace App\Http\Controllers;

use App\Models\Profesional;
use App\Models\User;
use App\Http\Requests\StoreProfesionalRequest;
use App\Http\Requests\UpdateProfesionalRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ProfesionalController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $this->authorize('viewAny', Profesional::class);
        
        $profesionales = Profesional::with('user')->paginate(15);
        return view('profesionales.index', compact('profesionales'));
    }

    public function create()
    {
        $this->authorize('create', Profesional::class);
        
        return view('profesionales.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Profesional::class);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'descripcion' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'rol' => 'profesional',
        ]);

        $profesional = Profesional::create([
            'user_id' => $user->id,
            'especialidad' => $validated['especialidad'],
            'telefono' => $validated['telefono'],
            'descripcion' => $validated['descripcion'],
        ]);

        // Log de auditoría
        Log::info('Profesional creado', [
            'profesional_id' => $profesional->id,
            'user_id' => $user->id,
            'created_by' => auth()->id(),
            'especialidad' => $profesional->especialidad,
        ]);

        return redirect()->route('profesionales.index')
            ->with('success', 'Profesional creado exitosamente.');
    }

    public function edit(Profesional $profesionale)
    {
        $this->authorize('update', $profesionale);
        
        return view('profesionales.edit', compact('profesionale'));
    }

    public function update(Request $request, Profesional $profesionale)
    {
        $this->authorize('update', $profesionale);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'descripcion' => 'nullable|string',
        ]);

        $profesionale->user->update([
            'name' => $validated['name'],
        ]);

        $profesionale->update([
            'especialidad' => $validated['especialidad'],
            'telefono' => $validated['telefono'],
            'descripcion' => $validated['descripcion'],
        ]);

        // Log de auditoría
        Log::info('Profesional actualizado', [
            'profesional_id' => $profesionale->id,
            'updated_by' => auth()->id(),
            'cambios' => $validated,
        ]);

        return redirect()->route('profesionales.index')
            ->with('success', 'Profesional actualizado exitosamente.');
    }

    public function destroy(Profesional $profesionale)
    {
        $this->authorize('delete', $profesionale);

        // Log de auditoría
        Log::info('Profesional eliminado', [
            'profesional_id' => $profesionale->id,
            'user_id' => $profesionale->user_id,
            'deleted_by' => auth()->id(),
        ]);

        $profesionale->user->delete();
        
        return redirect()->route('profesionales.index')
            ->with('success', 'Profesional eliminado exitosamente.');
    }
}
