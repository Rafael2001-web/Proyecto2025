<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unidad>
 */
class UnidadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'macrosector' => $this->faker->randomElement([
                'Desarrollo Social',
                'Desarrollo Económico',
                'Infraestructura',
                'Gobierno y Seguridad',
                'Medio Ambiente'
            ]),
            'sector' => $this->faker->randomElement([
                'Educación',
                'Salud',
                'Transporte',
                'Agricultura',
                'Tecnología',
                'Energía',
                'Turismo',
                'Industria',
                'Comercio',
                'Justicia'
            ]),
            'estado' => $this->faker->randomElement(['Activo', 'Inactivo']),
        ];
    }
}