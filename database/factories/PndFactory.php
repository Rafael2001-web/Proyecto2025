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
                'Eje 1: Desarrollo Sostenible',
                'Eje 2: Inclusión Social',
                'Eje 3: Innovación y Tecnología',
                'Eje 4: Infraestructura y Transporte',
                'Eje 5: Salud y Bienestar',
                'Eje 6: Educación y Cultura',
                'Eje 7: Gobernanza y Participación Ciudadana'
            ]),
            'objetivoN' => $this->faker->numberBetween(1, 10),
            'descripcion' => $this->faker->paragraph(3),
        ];
    }
}