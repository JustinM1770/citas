<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Profesional;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $stats = [
                'total_usuarios' => User::count(),
                'total_profesionales' => Profesional::count(),
                'total_servicios' => Servicio::count(),
                'total_citas' => Cita::count(),
                'citas_pendientes' => Cita::where('estado', 'pendiente')->count(),
                'citas_hoy' => Cita::whereDate('fecha', today())->count(),
            ];

            $citas_recientes = Cita::with(['user', 'profesional.user', 'servicio'])
                ->latest()
                ->take(5)
                ->get();

            return view('dashboard.admin', compact('stats', 'citas_recientes'));
        }

        if ($user->isProfesional()) {
            $profesional = $user->profesional;
            
            $citas_hoy = Cita::where('profesional_id', $profesional->id)
                ->whereDate('fecha', today())
                ->with(['user', 'servicio'])
                ->orderBy('hora')
                ->get();

            $proximas_citas = Cita::where('profesional_id', $profesional->id)
                ->where('fecha', '>', today())
                ->where('estado', '!=', 'cancelada')
                ->with(['user', 'servicio'])
                ->orderBy('fecha')
                ->orderBy('hora')
                ->take(5)
                ->get();

            return view('dashboard.profesional', compact('citas_hoy', 'proximas_citas'));
        }

        $mis_citas = Cita::where('user_id', $user->id)
            ->with(['profesional.user', 'servicio'])
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        $proximas = $mis_citas->where('fecha', '>=', today())
            ->where('estado', '!=', 'cancelada');

        $historial = $mis_citas->where('fecha', '<', today())
            ->sortByDesc('fecha');

        return view('dashboard.cliente', compact('proximas', 'historial'));
    }
}
