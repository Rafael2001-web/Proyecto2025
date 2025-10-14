<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\objEstrategico>
 */
class ObjEstrategicoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descripcion' => $this->faker->paragraph(2),
            'fechaRegistro' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'estado' => $this->faker->randomElement(['Activo', 'En Desarrollo', 'Finalizado']),
        ];
    }
}