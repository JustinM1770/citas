<?php

namespace Database\Seeders;

use App\Models\Horario;
use App\Models\Profesional;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    public function run(): void
    {
        $profesionales = Profesional::all();

        foreach ($profesionales as $profesional) {
            $dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes'];
            
            foreach ($dias as $dia) {
                Horario::create([
                    'profesional_id' => $profesional->id,
                    'dia_semana' => $dia,
                    'hora_inicio' => '09:00',
                    'hora_fin' => '13:00',
                ]);

                Horario::create([
                    'profesional_id' => $profesional->id,
                    'dia_semana' => $dia,
                    'hora_inicio' => '15:00',
                    'hora_fin' => '19:00',
                ]);
            }
        }
    }
}
