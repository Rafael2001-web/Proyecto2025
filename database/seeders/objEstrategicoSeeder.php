<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ObjEstrategicoSeeder extends Seeder
{
    /**
     * Seed the Objetivos Estratégicos table.
     */
    public function run(): void
    {
        $objetivosEstrategicos = [
            [
                'descripcion' => 'Incrementar la efectividad de la gestión de los procesos del ciclo de la planificación nacional contribuyendo al cumplimiento de los objetivos nacionales.',
                'estado' => 'Activo',
                'fechaRegistro' => Carbon::now()
            ],
            [
                'descripcion' => 'Incrementar la disponibilidad de datos e información relevante para los procesos del ciclo de la planificación en el marco del Sistema Nacional Descentralizado de Planificación Participativa.',
                'estado' => 'Activo',
                'fechaRegistro' => Carbon::now()
            ],
            [
                'descripcion' => 'Fortalecer las capacidades institucionales de la Secretaría Nacional de Planificación.',
                'estado' => 'Activo',
                'fechaRegistro' => Carbon::now()
            ]
        ];

        // Deshabilitar verificación de claves foráneas temporalmente
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncar la tabla antes de insertar para evitar duplicados
        DB::table('objestrategicos')->truncate();
        
        // Insertar todos los objetivos estratégicos
        DB::table('objestrategicos')->insert($objetivosEstrategicos);
        
        // Rehabilitar verificación de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('✅ Objetivos Estratégicos seedeados correctamente: 3 objetivos institucionales de la Secretaría Nacional de Planificación insertados.');
    }
}