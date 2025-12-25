<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pnd>
 */
class PndFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'eje' => $this->faker->randomElement([
                'Eje 1: Social',
                'Eje 2: Desarrollo Económico',
                'Eje 3: Infraestructura, Energía y Medio Ambiente',
                'Eje 4: Institucional',
                'Eje 5: Gestión de Riesgos',
            ]),
            'objetivoN' => $this->faker->numberBetween(1, 10),
            'descripcion' => $this->faker->paragraph(3),
        ];
    }
}