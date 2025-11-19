<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\Profesional;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = User::where('rol', 'cliente')->get();
        $profesionales = Profesional::all();
        $servicios = Servicio::all();

        Cita::create([
            'user_id' => $clientes[0]->id,
            'profesional_id' => $profesionales[0]->id,
            'servicio_id' => $servicios[0]->id,
            'fecha' => now()->addDays(2),
            'hora' => '10:00',
            'estado' => 'confirmada',
        ]);

        Cita::create([
            'user_id' => $clientes[1]->id,
            'profesional_id' => $profesionales[1]->id,
            'servicio_id' => $servicios[1]->id,
            'fecha' => now()->addDays(3),
            'hora' => '15:30',
            'estado' => 'pendiente',
        ]);

        Cita::create([
            'user_id' => $clientes[0]->id,
            'profesional_id' => $profesionales[0]->id,
            'servicio_id' => $servicios[2]->id,
            'fecha' => now()->addDays(5),
            'hora' => '11:00',
            'estado' => 'pendiente',
        ]);
    }
}
