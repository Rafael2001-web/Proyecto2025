<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proyecto>
 */
class ProyectoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaInicio = $this->faker->dateTimeBetween('-1 year', '+6 months');
        $fechaFin = $this->faker->dateTimeBetween($fechaInicio, '+2 years');
        
        return [
            'codigo' => 'PROY-' . $this->faker->unique()->numberBetween(10000, 99999),
            'nombre' => $this->faker->randomElement([
                'Construcción de Centro de Salud',
                'Mejoramiento de Infraestructura Vial',
                'Implementación de Sistema de Agua Potable',
                'Modernización Tecnológica',
                'Programa de Capacitación Docente',
                'Fortalecimiento Institucional',
                'Desarrollo de Energías Renovables',
                'Centro de Atención Ciudadana',
                'Parque Industrial',
                'Sistema de Transporte Público'
            ]) . ' - ' . $this->faker->city(),
            'descripcion' => $this->faker->paragraph(3),
            'sector' => $this->faker->randomElement([
                'Salud',
                'Educación',
                'Transporte',
                'Infraestructura',
                'Tecnología',
                'Energía',
                'Agua y Saneamiento',
                'Desarrollo Social',
                'Medio Ambiente',
                'Seguridad'
            ]),
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'presupuesto' => $this->faker->randomFloat(2, 50000, 10000000),
            'estado' => $this->faker->randomElement(['En Planificación', 'En Ejecución', 'Suspendido', 'Finalizado', 'Cancelado']),
            'user_id' => User::factory(),
        ];
}

}