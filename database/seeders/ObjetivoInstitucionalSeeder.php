<?php

namespace Database\Seeders;

use App\Models\ObjetivoInstitucional;
use App\Models\Pnd;
use App\Models\Ods;
use App\Models\objEstrategico;
use Illuminate\Database\Seeder;

class ObjetivoInstitucionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los registros necesarios
        $pnds = Pnd::all();
        $odss = Ods::all();
        $objetivosEstrategicos = objEstrategico::all();

        // Validar que existan datos
        if ($pnds->isEmpty() || $odss->isEmpty() || $objetivosEstrategicos->isEmpty()) {
            $this->command->warn('⚠️ No hay suficientes datos en PND, ODS u Objetivos Estratégicos para crear alineaciones.');
            return;
        }

        $this->command->info('🎯 Creando objetivos institucionales...');

        $objetivosInstitucionales = [
            // Ejemplo 1: Eje Justicia y Estado de Derecho + ODS 16 (Paz, Justicia) + Objetivo Estratégico relacionado
            [
                'idPnd' => $pnds->where('eje', 'Justicia y Estado de Derecho')->first()?->idPnd ?? 1,
                'idOds' => $odss->where('odsnum', 16)->first()?->idOds ?? 16,
                'idobjEstrategico' => $objetivosEstrategicos->first()->idobjEstrategico,
                'nivel_alineacion' => 'Alto',
                'justificacion' => 'Fortalecer la justicia institucional alineada con ODS 16 para promover sociedades pacíficas e inclusivas.'
            ],

            // Ejemplo 2: Bienestar + ODS 3 (Salud y bienestar)
            [
                'idPnd' => $pnds->where('eje', 'Bienestar')->first()?->idPnd ?? 2,
                'idOds' => $odss->where('odsnum', 3)->first()?->idOds ?? 3,
                'idobjEstrategico' => $objetivosEstrategicos->skip(1)->first()?->idobjEstrategico ?? $objetivosEstrategicos->first()->idobjEstrategico,
                'nivel_alineacion' => 'Alto',
                'justificacion' => 'Garantizar la salud y el bienestar de la población mediante políticas públicas efectivas.'
            ],

            // Ejemplo 3: Desarrollo Económico + ODS 8 (Trabajo decente)
            [
                'idPnd' => $pnds->where('eje', 'Desarrollo Económico')->first()?->idPnd ?? 3,
                'idOds' => $odss->where('odsnum', 8)->first()?->idOds ?? 8,
                'idobjEstrategico' => $objetivosEstrategicos->skip(2)->first()?->idobjEstrategico ?? $objetivosEstrategicos->first()->idobjEstrategico,
                'nivel_alineacion' => 'Alto',
                'justificacion' => 'Promover el crecimiento económico sostenido, inclusivo y sostenible con trabajo decente.'
            ],

            // Ejemplo 4: Desarrollo Económico + ODS 9 (Industria e Innovación)
            [
                'idPnd' => $pnds->where('eje', 'Desarrollo Económico')->first()?->idPnd ?? 3,
                'idOds' => $odss->where('odsnum', 9)->first()?->idOds ?? 9,
                'idobjEstrategico' => $objetivosEstrategicos->skip(2)->first()?->idobjEstrategico ?? $objetivosEstrategicos->first()->idobjEstrategico,
                'nivel_alineacion' => 'Medio',
                'justificacion' => 'Construir infraestructuras resilientes y fomentar la innovación industrial.'
            ],

            // Ejemplo 5: Bienestar + ODS 4 (Educación de calidad)
            [
                'idPnd' => $pnds->where('eje', 'Bienestar')->first()?->idPnd ?? 2,
                'idOds' => $odss->where('odsnum', 4)->first()?->idOds ?? 4,
                'idobjEstrategico' => $objetivosEstrategicos->skip(3)->first()?->idobjEstrategico ?? $objetivosEstrategicos->first()->idobjEstrategico,
                'nivel_alineacion' => 'Alto',
                'justificacion' => 'Garantizar educación inclusiva, equitativa y de calidad para todos.'
            ],

            // Ejemplo 6: Desarrollo Sostenible + ODS 13 (Acción climática)
            [
                'idPnd' => $pnds->where('eje', 'Desarrollo Sostenible')->first()?->idPnd ?? 4,
                'idOds' => $odss->where('odsnum', 13)->first()?->idOds ?? 13,
                'idobjEstrategico' => $objetivosEstrategicos->skip(4)->first()?->idobjEstrategico ?? $objetivosEstrategicos->first()->idobjEstrategico,
                'nivel_alineacion' => 'Alto',
                'justificacion' => 'Adoptar medidas urgentes para combatir el cambio climático y sus efectos.'
            ],

            // Ejemplo 7: Bienestar + ODS 2 (Hambre cero)
            [
                'idPnd' => $pnds->where('eje', 'Bienestar')->first()?->idPnd ?? 2,
                'idOds' => $odss->where('odsnum', 2)->first()?->idOds ?? 2,
                'idobjEstrategico' => $objetivosEstrategicos->skip(5)->first()?->idobjEstrategico ?? $objetivosEstrategicos->first()->idobjEstrategico,
                'nivel_alineacion' => 'Medio',
                'justificacion' => 'Poner fin al hambre mediante seguridad alimentaria y nutrición mejorada.'
            ],

            // Ejemplo 8: Justicia + ODS 5 (Igualdad de género)
            [
                'idPnd' => $pnds->where('eje', 'Justicia y Estado de Derecho')->first()?->idPnd ?? 1,
                'idOds' => $odss->where('odsnum', 5)->first()?->idOds ?? 5,
                'idobjEstrategico' => $objetivosEstrategicos->skip(6)->first()?->idobjEstrategico ?? $objetivosEstrategicos->first()->idobjEstrategico,
                'nivel_alineacion' => 'Alto',
                'justificacion' => 'Lograr la igualdad de género y empoderar a todas las mujeres y niñas.'
            ],
        ];

        foreach ($objetivosInstitucionales as $objInst) {
            ObjetivoInstitucional::create($objInst);
        }

        $this->command->info('✅ Objetivos institucionales creados exitosamente: ' . count($objetivosInstitucionales));
    }
}
