<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Primero los usuarios (necesarios para proyectos)
            AdminUserSeeder::class,

            // Roles y permisos (después de usuarios)
            RoleSeeder::class,

            // Entidades base del sistema
            EntidadSeeder::class,
            UnidadSeeder::class,

            // Objetivos y marcos estratégicos
            OdsSeeder::class,
            PndSeeder::class,
            ObjEstrategicoSeeder::class,

            // Alineaciones estratégicas (después de tener ODS, PND y Obj. Estratégicos)
            ObjetivoInstitucionalSeeder::class,

            // Planificación e inversión
            PlanSeeder::class,
            ProgramaSeeder::class,
            ProyectoSeeder::class,
        ]);
    }
}
