<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ods>
 */
class OdsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $odsData = [
            1 => ['Fin de la Pobreza', 'Poner fin a la pobreza en todas sus formas en todo el mundo'],
            2 => ['Hambre Cero', 'Poner fin al hambre, lograr la seguridad alimentaria'],
            3 => ['Salud y Bienestar', 'Garantizar una vida sana y promover el bienestar'],
            4 => ['Educación de Calidad', 'Garantizar una educación inclusiva, equitativa y de calidad'],
            5 => ['Igualdad de Género', 'Lograr la igualdad entre los géneros'],
            6 => ['Agua Limpia y Saneamiento', 'Garantizar la disponibilidad de agua'],
            7 => ['Energía Asequible y No Contaminante', 'Garantizar el acceso a una energía asequible'],
            8 => ['Trabajo Decente y Crecimiento Económico', 'Promover el crecimiento económico sostenido'],
            9 => ['Industria, Innovación e Infraestructura', 'Construir infraestructuras resilientes'],
            10 => ['Reducción de las Desigualdades', 'Reducir la desigualdad en y entre los países'],
            11 => ['Ciudades y Comunidades Sostenibles', 'Lograr que las ciudades sean inclusivas'],
            12 => ['Producción y Consumo Responsables', 'Garantizar modalidades de consumo y producción sostenibles'],
            13 => ['Acción por el Clima', 'Adoptar medidas urgentes para combatir el cambio climático'],
            14 => ['Vida Submarina', 'Conservar y utilizar sosteniblemente los océanos'],
            15 => ['Vida de Ecosistemas Terrestres', 'Gestionar sosteniblemente los bosques'],
            16 => ['Paz, Justicia e Instituciones Sólidas', 'Promover sociedades justas, pacíficas e inclusivas'],
            17 => ['Alianzas para Lograr los Objetivos', 'Revitalizar la Alianza Mundial para el Desarrollo Sostenible']
        ];
        
        $odsNumber = $this->faker->numberBetween(1, 17);
        $selectedOds = $odsData[$odsNumber];
        
        return [
            'odsnum' => $odsNumber,
            'nombre' => $selectedOds[0],
            'descripcion' => $selectedOds[1] . '. ' . $this->faker->paragraph(2),
        ];
    }
}