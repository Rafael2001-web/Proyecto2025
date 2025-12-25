<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PndSeeder extends Seeder
{
    /**
     * Seed the PND (Plan Nacional de Desarrollo) table.
     */
    public function run(): void
    {
        $objetivosPnd = [
            // EJE Social
            [
                'eje' => 'EJE Social',
                'objetivoN' => 1,
                'descripcion' => 'Mejorar las condiciones de vida de la población de forma integral, promoviendo el acceso equitativo a salud, vivienda y bienestar social'
            ],
            [
                'eje' => 'EJE Social',
                'objetivoN' => 2,
                'descripcion' => 'Impulsar las capacidades de la ciudadanía con educación equitativa e inclusiva de calidad y promoviendo espacios de intercambio cultural'
            ],
            [
                'eje' => 'EJE Social',
                'objetivoN' => 3,
                'descripcion' => 'Garantizar la seguridad integral, la paz ciudadana, y transformar el sistema de justicia respetando los derechos humanos'
            ],
            
            // EJE Desarrollo económico
            [
                'eje' => 'EJE Desarrollo económico',
                'objetivoN' => 4,
                'descripcion' => 'Estimular el sistema económico y de finanzas públicas para dinamizar la inversión y las relaciones comerciales'
            ],
            [
                'eje' => 'EJE Desarrollo económico',
                'objetivoN' => 5,
                'descripcion' => 'Fomentar de manera sustentable la producción mejorando los niveles de productividad'
            ],
            [
                'eje' => 'EJE Desarrollo económico',
                'objetivoN' => 6,
                'descripcion' => 'Incentivar la generación de empleo digno'
            ],
            
            // EJE Infraestructura, energía y medio ambiente
            [
                'eje' => 'EJE Infraestructura, energía y medio ambiente',
                'objetivoN' => 7,
                'descripcion' => 'Precautelar el uso responsable de los recursos naturales con un entorno ambientalmente sostenible'
            ],
            [
                'eje' => 'EJE Infraestructura, energía y medio ambiente',
                'objetivoN' => 8,
                'descripcion' => 'Impulsar la conectividad como fuente de desarrollo y crecimiento económico y sostenible'
            ],
            
            // EJE Institucional
            [
                'eje' => 'EJE Institucional',
                'objetivoN' => 9,
                'descripcion' => 'Propender la construcción de un Estado eficiente, transparente y orientado al bienestar social'
            ],
            
            // EJE Gestión de Riesgos
            [
                'eje' => 'EJE Gestión de Riesgos',
                'objetivoN' => 10,
                'descripcion' => 'Promover la resiliencia de ciudades y comunidades para enfrentar los riesgos de origen natural y antrópico'
            ]
        ];

        // Deshabilitar verificación de claves foráneas temporalmente
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncar la tabla antes de insertar para evitar duplicados
        DB::table('pnd')->truncate();
        
        // Insertar todos los objetivos del PND
        DB::table('pnd')->insert($objetivosPnd);
        
        // Rehabilitar verificación de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('✅ PND seedeado correctamente: 10 objetivos nacionales del Plan Nacional de Desarrollo 2024-2025 insertados.');
    }
}