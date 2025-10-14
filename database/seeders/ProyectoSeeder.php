<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proyecto;
use App\Models\User;


class ProyectoSeeder extends Seeder
{
    public function run()
    {
        // Crear 20 proyectos asignados aleatoriamente a los usuarios
        Proyecto::factory(20)->create([
            'user_id' => function() {
                return User::inRandomOrder()->first()->id;
            }
        ]);

        // Mensaje de confirmación
        $this->command->info('¡20 proyectos de prueba creados exitosamente!');
    }
}