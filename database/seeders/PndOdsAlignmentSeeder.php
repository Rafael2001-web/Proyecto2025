<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PndOdsAlignmentSeeder extends Seeder
{
    /**
     * Seed the PND-ODS alignment table based on PND 2024-2025 alignment with Agenda 2030.
     */
    public function run(): void
    {
        $alignments = [
            // Objetivo Nacional 1: Mejorar las condiciones de vida (EJE Social)
            ['idPnd' => 1, 'idOds' => 1, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Mejora directa de condiciones de vida reduce la pobreza'],
            ['idPnd' => 1, 'idOds' => 2, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Acceso a alimentación como parte del bienestar integral'],
            ['idPnd' => 1, 'idOds' => 3, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Salud como componente central del bienestar social'],
            ['idPnd' => 1, 'idOds' => 11, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Vivienda digna para comunidades sostenibles'],

            // Objetivo Nacional 2: Impulsar capacidades ciudadanas (EJE Social)
            ['idPnd' => 2, 'idOds' => 4, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Educación equitativa e inclusiva de calidad'],
            ['idPnd' => 2, 'idOds' => 8, 'nivel_alineacion' => 'Medio', 'justificacion' => 'Educación contribuye al desarrollo económico'],
            ['idPnd' => 2, 'idOds' => 10, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Educación reduce desigualdades sociales'],

            // Objetivo Nacional 3: Garantizar seguridad integral (EJE Social)
            ['idPnd' => 3, 'idOds' => 5, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Respeto a derechos humanos incluye igualdad de género'],
            ['idPnd' => 3, 'idOds' => 16, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Paz ciudadana y sistema de justicia efectivo'],
            ['idPnd' => 3, 'idOds' => 11, 'nivel_alineacion' => 'Medio', 'justificacion' => 'Seguridad integral para comunidades sostenibles'],

            // Objetivo Nacional 4: Estimular sistema económico (EJE Desarrollo económico)
            ['idPnd' => 4, 'idOds' => 8, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Dinamización económica genera crecimiento y empleo'],
            ['idPnd' => 4, 'idOds' => 9, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Inversión en infraestructura e innovación'],
            ['idPnd' => 4, 'idOds' => 17, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Relaciones comerciales requieren alianzas'],

            // Objetivo Nacional 5: Fomentar producción sustentable (EJE Desarrollo económico)
            ['idPnd' => 5, 'idOds' => 2, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Producción agrícola sostenible combate el hambre'],
            ['idPnd' => 5, 'idOds' => 8, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Productividad contribuye al crecimiento económico'],
            ['idPnd' => 5, 'idOds' => 12, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Producción sustentable y consumo responsable'],
            ['idPnd' => 5, 'idOds' => 17, 'nivel_alineacion' => 'Medio', 'justificacion' => 'Alianzas para fortalecer cadenas productivas'],

            // Objetivo Nacional 6: Incentivar empleo digno (EJE Desarrollo económico)
            ['idPnd' => 6, 'idOds' => 8, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Empleo digno es core del ODS 8'],

            // Objetivo Nacional 7: Uso responsable recursos naturales (EJE Infraestructura, energía y medio ambiente)
            ['idPnd' => 7, 'idOds' => 6, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Gestión sostenible del agua'],
            ['idPnd' => 7, 'idOds' => 7, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Energía limpia y sostenible'],
            ['idPnd' => 7, 'idOds' => 11, 'nivel_alineacion' => 'Medio', 'justificacion' => 'Comunidades ambientalmente sostenibles'],
            ['idPnd' => 7, 'idOds' => 13, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Acción climática y sostenibilidad ambiental'],
            ['idPnd' => 7, 'idOds' => 14, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Conservación de recursos marinos'],
            ['idPnd' => 7, 'idOds' => 15, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Conservación de ecosistemas terrestres'],

            // Objetivo Nacional 8: Impulsar conectividad (EJE Infraestructura, energía y medio ambiente)
            ['idPnd' => 8, 'idOds' => 9, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Infraestructura de conectividad e innovación'],
            ['idPnd' => 8, 'idOds' => 11, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Conectividad para ciudades sostenibles'],

            // Objetivo Nacional 9: Estado eficiente (EJE Institucional)
            ['idPnd' => 9, 'idOds' => 16, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Instituciones eficaces y transparentes'],
            ['idPnd' => 9, 'idOds' => 5, 'nivel_alineacion' => 'Medio', 'justificacion' => 'Estado inclusivo promueve igualdad de género'],
            ['idPnd' => 9, 'idOds' => 10, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Estado orientado al bienestar reduce desigualdades'],

            // Objetivo Nacional 10: Resiliencia ante riesgos (EJE Gestión de Riesgos)
            ['idPnd' => 10, 'idOds' => 11, 'nivel_alineacion' => 'Alto', 'justificacion' => 'Resiliencia urbana ante riesgos naturales y antrópicos'],
        ];

        // Deshabilitar verificación de claves foráneas temporalmente
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncar la tabla antes de insertar para evitar duplicados
        DB::table('pnd_ods_alignment')->truncate();
        
        // Insertar todas las alineaciones PND-ODS
        DB::table('pnd_ods_alignment')->insert($alignments);
        
        // Rehabilitar verificación de claves foráneas
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('✅ Alineación PND-ODS seedeada correctamente: ' . count($alignments) . ' relaciones de alineación insertadas basadas en PND 2024-2025.');
    }
}