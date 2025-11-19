<?php

namespace Database\Seeders;

use App\Models\Profesional;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfesionalSeeder extends Seeder
{
    public function run(): void
    {
        $juan = User::where('email', 'juan@citas.com')->first();
        $maria = User::where('email', 'maria@citas.com')->first();

        Profesional::create([
            'user_id' => $juan->id,
            'especialidad' => 'Medicina General',
            'telefono' => '555-0001',
            'descripcion' => 'Médico general con 10 años de experiencia',
        ]);

        Profesional::create([
            'user_id' => $maria->id,
            'especialidad' => 'Psicología Clínica',
            'telefono' => '555-0002',
            'descripcion' => 'Psicóloga especializada en terapia cognitivo-conductual',
        ]);
    }
}
