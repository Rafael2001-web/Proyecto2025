<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OdsSeeder extends Seeder
{
    /**
     * Seed the ODS (Objetivos de Desarrollo Sostenible) table.
     */
    public function run(): void
    {
        $ods = [
            [
                'odsnum' => 1,
                'nombre' => 'Fin de la Pobreza',
                'descripcion' => 'Poner fin a la pobreza en todas sus formas en todo el mundo.'
            ],
            [
                'odsnum' => 2,
                'nombre' => 'Hambre Cero',
                'descripcion' => 'Poner fin al hambre, lograr la seguridad alimentaria y la mejora de la nutrición y promover la agricultura sostenible.'
            ],
            [
                'odsnum' => 3,
                'nombre' => 'Salud y Bienestar',
                'descripcion' => 'Garantizar una vida sana y promover el bienestar para todos en todas las edades.'
            ],
            [
                'odsnum' => 4,
                'nombre' => 'Educación de Calidad',
                'descripcion' => 'Garantizar una educación inclusiva, equitativa y de calidad y promover oportunidades de aprendizaje durante toda la vida para todos.'
            ],
            [
                'odsnum' => 5,
                'nombre' => 'Igualdad de Género',
                'descripcion' => 'Lograr la igualdad entre los géneros y empoderar a todas las mujeres y las niñas.'
            ],
            [
                'odsnum' => 6,
                'nombre' => 'Agua Limpia y Saneamiento',
                'descripcion' => 'Garantizar la disponibilidad de agua y su gestión sostenible y el saneamiento para todos.'
            ],
            [
                'odsnum' => 7,
                'nombre' => 'Energía Asequible y No Contaminante',
                'descripcion' => 'Garantizar el acceso a una energía asequible, segura, sostenible y moderna para todos.'
            ],
            [
                'odsnum' => 8,
                'nombre' => 'Trabajo Decente y Crecimiento Económico',
                'descripcion' => 'Promover el crecimiento económico sostenido, inclusivo y sostenible, el empleo pleno y productivo y el trabajo decente para todos.'
            ],
            [
                'odsnum' => 9,
                'nombre' => 'Industria, Innovación e Infraestructura',
                'descripcion' => 'Construir infraestructuras resilientes, promover la industrialización inclusiva y sostenible y fomentar la innovación.'
            ],
            [
                'odsnum' => 10,
                'nombre' => 'Reducción de las Desigualdades',
                'descripcion' => 'Reducir la desigualdad en y entre los países.'
            ],
            [
                'odsnum' => 11,
                'nombre' => 'Ciudades y Comunidades Sostenibles',
                'descripcion' => 'Lograr que las ciudades y los asentamientos humanos sean inclusivos, seguros, resilientes y sostenibles.'
            ],
            [
                'odsnum' => 12,
                'nombre' => 'Producción y Consumo Responsables',
                'descripcion' => 'Garantizar modalidades de consumo y producción sostenibles.'
            ],
            [
                'odsnum' => 13,
                'nombre' => 'Acción por el Clima',
                'descripcion' => 'Adoptar medidas urgentes para combatir el cambio climático y sus efectos.'
            ],
            [
                'odsnum' => 14,
                'nombre' => 'Vida Submarina',
                'descripcion' => 'Conservar y utilizar en forma sostenible los océanos, los mares y los recursos marinos para el desarrollo sostenible.'
            ],
            [
                'odsnum' => 15,
                'nombre' => 'Vida de Ecosistemas Terrestres',
                'descripcion' => 'Proteger, restablecer y promover el uso sostenible de los ecosistemas terrestres, gestionar los bosques de forma sostenible, luchar contra la desertificación, detener e invertir la degradación de las tierras y poner freno a la pérdida de la diversidad biológica.'
            ],
            [
                'odsnum' => 16,
                'nombre' => 'Paz, Justicia e Instituciones Sólidas',
                'descripcion' => 'Promover sociedades pacíficas e inclusivas para el desarrollo sostenible, facilitar el acceso a la justicia para todos y crear instituciones eficaces, responsables e inclusivas a todos los niveles.'
            ],
            [
                'odsnum' => 17,
                'nombre' => 'Alianzas para Lograr los Objetivos',
                'descripcion' => 'Fortalecer los medios de ejecución y revitalizar la Alianza Mundial para el Desarrollo Sostenible.'
            ]
        ];

        // Deshabilitar verificación de claves foráneas temporalmente
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncar la tabla antes de insertar para evitar duplicados
        DB::table('ods')->truncate();
        
        // Insertar todos los ODS
        DB::table('ods')->insert($ods);
        
        // Rehabilitar verificación de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('✅ ODS seedeados correctamente: 17 Objetivos de Desarrollo Sostenible insertados.');
    }
}