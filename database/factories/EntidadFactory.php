<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Entidad>
 */
class EntidadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => $this->faker->unique()->numberBetween(1000, 9999),
            'subSector' => $this->faker->randomElement([
                'Educación Básica',
                'Educación Superior',
                'Salud Pública',
                'Infraestructura Vial',
                'Transporte Público',
                'Tecnología e Innovación',
                'Finanzas Públicas',
                'Seguridad y Convivencia',
                'Medio Ambiente',
                'Desarrollo Rural'
            ]),
            'nivelGobierno' => $this->faker->randomElement(['Nacional', 'Departamental', 'Municipal', 'Distrital']),
            'estado' => $this->faker->randomElement(['Activo', 'Inactivo', 'En Reorganización']),
            'fechaCreacion' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'fechaActualizacion' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
