<?php

namespace Database\Seeders;

use App\Models\Actividad;
use App\Models\ActividadAuditoria;
use App\Models\Proyecto;
use App\Models\User;
use App\Models\objEstrategico;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('actividad_objetivos_estrategicos')->truncate();
        DB::table('actividad_auditorias')->truncate();
        DB::table('actividades')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $proyectos = Proyecto::all();
        $objetivos = objEstrategico::all();
        $usuario = User::first();

        foreach ($proyectos as $proyecto) {
            for ($i = 1; $i <= 3; $i++) {
                $inicioPlan = Carbon::now()->subDays(random_int(0, 30));
                $finPlan = (clone $inicioPlan)->addDays(random_int(5, 30));

                $avanceReal = random_int(0, 100);
                $estado = $avanceReal >= 100 ? 'COMPLETADA' : ($avanceReal > 0 ? 'EN_PROGRESO' : 'PLANIFICADA');

                $finReal = null;
                if ($avanceReal >= 100) {
                    $finReal = (clone $finPlan)->addDays(random_int(-2, 5));
                }

                $variacion = $finReal ? $finPlan->diffInDays($finReal, false) : null;
                $estadoReportado = $avanceReal <= 0
                    ? 'NO_INICIADA'
                    : ($finReal && $finReal->lte($finPlan) ? 'COMPLETADA' : 'EN_RIESGO');

                $actividad = Actividad::create([
                    'proyecto_id' => $proyecto->id,
                    'codigo' => 'ACT' . str_pad((string) $i, 3, '0', STR_PAD_LEFT),
                    'nombre' => 'Actividad ' . $i . ' - ' . $proyecto->nombre,
                    'descripcion' => 'Actividad generada para pruebas de seguimiento.',
                    'responsable' => $usuario ? $usuario->name : null,
                    'estado' => $estado,
                    'prioridad' => random_int(1, 5),
                    'fecha_inicio_planificada' => $inicioPlan->toDateString(),
                    'fecha_fin_planificada' => $finPlan->toDateString(),
                    'fecha_inicio_real' => $avanceReal > 0 ? $inicioPlan->toDateString() : null,
                    'fecha_fin_real' => $finReal ? $finReal->toDateString() : null,
                    'duracion_planificada_dias' => $inicioPlan->diffInDays($finPlan),
                    'avance_planificado' => 100,
                    'avance_real' => $avanceReal,
                    'variacion_tiempo_dias' => $variacion,
                    'estado_reportado' => $estadoReportado,
                    'activo' => true
                ]);

                if ($objetivos->isNotEmpty()) {
                    $ids = $objetivos->random(min(2, $objetivos->count()))->pluck('idobjEstrategico')->toArray();
                    $actividad->objetivosEstrategicos()->sync($ids);
                }

                if ($usuario) {
                    ActividadAuditoria::create([
                        'actividad_id' => $actividad->id,
                        'user_id' => $usuario->id,
                        'accion' => 'CREAR',
                        'detalle' => 'Seeder de actividades'
                    ]);
                }
            }
        }

        $this->command->info('✅ Actividades creadas correctamente.');
    }
}