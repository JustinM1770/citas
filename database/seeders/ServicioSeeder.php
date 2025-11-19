<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    public function run(): void
    {
        Servicio::create([
            'nombre' => 'Consulta General',
            'descripcion' => 'Consulta médica general',
            'duracion' => 30,
            'precio' => 50.00,
        ]);

        Servicio::create([
            'nombre' => 'Terapia Psicológica',
            'descripcion' => 'Sesión de terapia psicológica individual',
            'duracion' => 60,
            'precio' => 80.00,
        ]);

        Servicio::create([
            'nombre' => 'Fisioterapia',
            'descripcion' => 'Sesión de fisioterapia y rehabilitación',
            'duracion' => 45,
            'precio' => 60.00,
        ]);

        Servicio::create([
            'nombre' => 'Nutrición',
            'descripcion' => 'Consulta nutricional personalizada',
            'duracion' => 40,
            'precio' => 55.00,
        ]);

        Servicio::create([
            'nombre' => 'Odontología',
            'descripcion' => 'Consulta odontológica general',
            'duracion' => 30,
            'precio' => 45.00,
        ]);
    }
}
