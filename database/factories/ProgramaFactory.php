<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Entidad;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Programa>
 */
class ProgramaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fechaInicio = $this->faker->dateTimeBetween('-1 year', '+6 months');
        $fechaFin = $this->faker->dateTimeBetween($fechaInicio, '+3 years');
        
        return [
            //relacion con entidad
            'idEntidad' => Entidad::inRandomOrder()->first()?->idEntidad ?? Entidad::factory(),
            'nombre' => $this->faker->randomElement([
                'Programa Nacional de Educación',
                'Programa de Desarrollo Rural',
                'Programa de Salud Materno Infantil',
                'Programa de Infraestructura Vial',
                'Programa de Tecnología e Innovación',
                'Programa de Desarrollo Sostenible',
                'Programa de Seguridad Ciudadana',
                'Programa de Fortalecimiento Institucional'
            ]) . ' ' . $this->faker->year(),
            'descripcion' => $this->faker->paragraph(2),
        ];
    }
}