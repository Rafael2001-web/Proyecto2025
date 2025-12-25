<?php

namespace Database\Factories;

use App\Models\Entidad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaInicio = $this->faker->dateTimeBetween('-2 years', '+1 year');
        $fechaFin = $this->faker->dateTimeBetween($fechaInicio, '+3 years');

        return [
            'codigo' => 'PLAN-' . $this->faker->unique()->numberBetween(1000, 9999),
            'nombre' => $this->faker->randomElement([
                'Plan Nacional de Desarrollo',
                'Plan Estratégico Institucional',
                'Plan de Desarrollo Regional',
                'Plan de Modernización',
                'Plan de Infraestructura',
                'Plan de Educación',
                'Plan de Salud Pública',
                'Plan de Desarrollo Sostenible'
            ]) . ' ' . $this->faker->year(),
            'idEntidad' => Entidad::inRandomOrder()->first()?->idEntidad ?? Entidad::factory(),
            'presupuesto' => $this->faker->randomFloat(2, 100000, 50000000),
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
            'estado' => $this->faker->randomElement(['Aprobado', 'Borrador', 'Rechazado']),
        ];
    }
}
