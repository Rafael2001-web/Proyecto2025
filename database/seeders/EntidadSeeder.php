<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Entidad;

class EntidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Entidad::factory(20)->create();

        $this->command->info('¡20 entidades de prueba creadas exitosamente!');
    }
}
