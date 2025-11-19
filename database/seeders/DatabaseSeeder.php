<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuarios con roles
        User::create([
            'name' => 'Admin Sistema',
            'email' => 'admin@citas.com',
            'password' => bcrypt('password'),
            'rol' => 'admin',
        ]);

        User::create([
            'name' => 'Juan Pérez',
            'email' => 'juan@citas.com',
            'password' => bcrypt('password'),
            'rol' => 'profesional',
        ]);

        User::create([
            'name' => 'María González',
            'email' => 'maria@citas.com',
            'password' => bcrypt('password'),
            'rol' => 'profesional',
        ]);

        User::create([
            'name' => 'Pedro López',
            'email' => 'pedro@citas.com',
            'password' => bcrypt('password'),
            'rol' => 'cliente',
        ]);

        User::create([
            'name' => 'Ana Martínez',
            'email' => 'ana@citas.com',
            'password' => bcrypt('password'),
            'rol' => 'cliente',
        ]);

        $this->call([
            ServicioSeeder::class,
            ProfesionalSeeder::class,
            HorarioSeeder::class,
            CitaSeeder::class,
        ]);
    }
}
