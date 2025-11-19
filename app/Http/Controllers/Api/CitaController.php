<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with(['user', 'profesional.user', 'servicio'])
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return response()->json($citas);
    }
}
