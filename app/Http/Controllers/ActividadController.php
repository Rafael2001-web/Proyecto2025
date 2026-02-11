<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Actividad;
use App\Models\ActividadAuditoria;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::any(['view actividades', 'manage actividades']);
        // Lógica para obtener y mostrar la lista de actividades
        $actividades = Actividad::with(['objetivosEstrategicos', 'proyecto'])
            ->where('activo', true)
            ->get();

        return view('actividades.index', compact('actividades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::any(['create actividades', 'manage actividades']);
        $validated = $request->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'codigo' => 'nullable|string|max:50',
            'nombre' => 'required|string|max:255',
            'estadoAct'=> 'required|string',
            'descripcion' => 'nullable|string',
            'responsable' => 'nullable|string|max:255',
            'estado' => 'required|in:PLANIFICADA,EN_PROGRESO,COMPLETADA',
            'prioridad' => 'required|integer|min:1|max:5',
            'fecha_inicio_planificada' => 'required|date',
            'fecha_fin_planificada' => 'required|date|after_or_equal:fecha_inicio_planificada',
            'fecha_inicio_real' => 'nullable|date',
            'fecha_fin_real' => 'nullable|date|after_or_equal:fecha_inicio_real',
            'avance_planificado' => 'nullable|numeric|min:0|max:100',
            'avance_real' => 'nullable|numeric|min:0|max:100',
            'objetivos_estrategicos' => 'required|array|min:1',
            'objetivos_estrategicos.*' => 'exists:objEstrategicos,idobjEstrategico'
        ]);

        $codigo = $validated['codigo'] ?: $this->generarCodigo($validated['proyecto_id']);
        $data = array_merge($validated, [
            'codigo' => $codigo
        ], $this->calcularCampos($request));

        $actividad = Actividad::create($data);
        $actividad->objetivosEstrategicos()->sync($request->input('objetivos_estrategicos', []));
        $this->registrarAuditoria($actividad, 'CREAR');

        return redirect()->route('actividades.index')
            ->with('success', 'Actividad creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::any(['view actividades', 'manage actividades']);
        $actividad = Actividad::with(['objetivosEstrategicos', 'proyecto'])->findOrFail($id);
        return view('actividades.show', compact('actividad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::any(['edit actividades', 'manage actividades']);
        $validated = $request->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'codigo' => 'required|string|max:50',
            'nombre' => 'required|string|max:255',
            'estadoAct'=> 'required|string',
            'descripcion' => 'nullable|string',
            'responsable' => 'nullable|string|max:255',
            'estado' => 'required|in:PLANIFICADA,EN_PROGRESO,COMPLETADA',
            'prioridad' => 'required|integer|min:1|max:5',
            'fecha_inicio_planificada' => 'required|date',
            'fecha_fin_planificada' => 'required|date|after_or_equal:fecha_inicio_planificada',
            'fecha_inicio_real' => 'nullable|date',
            'fecha_fin_real' => 'nullable|date|after_or_equal:fecha_inicio_real',
            'avance_planificado' => 'nullable|numeric|min:0|max:100',
            'avance_real' => 'nullable|numeric|min:0|max:100',
            'objetivos_estrategicos' => 'required|array|min:1',
            'objetivos_estrategicos.*' => 'exists:objEstrategicos,idobjEstrategico'
        ]);

        $actividad = Actividad::findOrFail($id);
        $data = array_merge($validated, $this->calcularCampos($request));
        $actividad->update($data);
        $actividad->objetivosEstrategicos()->sync($request->input('objetivos_estrategicos', []));
        $this->registrarAuditoria($actividad, 'ACTUALIZAR');

        return redirect()->route('actividades.index')
            ->with('success', 'Actividad actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::any(['delete actividades', 'manage actividades']);
        $actividad = Actividad::findOrFail($id);
        $actividad->update(['activo' => false]);
        $this->registrarAuditoria($actividad, 'ELIMINAR');

        return redirect()->route('actividades.index')
            ->with('success', 'Actividad eliminada correctamente');
    }

    public function documentopdf()
    {
        Gate::any(['view actividades', 'manage actividades']);
        $actividades = Actividad::with(['objetivosEstrategicos', 'proyecto'])
            ->where('activo', true)
            ->get();
        $pdf = PDF::loadView('actividades.pdf', compact('actividades'));
        return $pdf->stream('actividades.pdf');
    }

    private function generarCodigo(int $proyectoId): string
    {
        $count = Actividad::where('proyecto_id', $proyectoId)->count() + 1;
        return 'ACT' . str_pad((string) $count, 3, '0', STR_PAD_LEFT);
    }

    private function calcularCampos(Request $request): array
    {
        $inicioPlan = $request->fecha_inicio_planificada
            ? Carbon::parse($request->fecha_inicio_planificada)
            : null;
        $finPlan = $request->fecha_fin_planificada
            ? Carbon::parse($request->fecha_fin_planificada)
            : null;
        $finReal = $request->fecha_fin_real
            ? Carbon::parse($request->fecha_fin_real)
            : null;

        $duracionPlanificada = null;
        if ($inicioPlan && $finPlan) {
            $duracionPlanificada = $inicioPlan->diffInDays($finPlan);
        }

        $variacionTiempo = null;
        if ($finPlan && $finReal) {
            $variacionTiempo = $finPlan->diffInDays($finReal, false);
        }

        $avanceReal = $request->avance_real;
        $estadoReportado = 'NO_INICIADA';
        if ($avanceReal !== null && $avanceReal > 0) {
            if ($finPlan && $finReal && $finReal->lte($finPlan)) {
                $estadoReportado = 'COMPLETADA';
            } else {
                $estadoReportado = 'EN_RIESGO';
            }
        }

        return [
            'duracion_planificada_dias' => $duracionPlanificada,
            'variacion_tiempo_dias' => $variacionTiempo,
            'estado_reportado' => $estadoReportado
        ];
    }

    private function registrarAuditoria(Actividad $actividad, string $accion): void
    {
        ActividadAuditoria::create([
            'actividad_id' => $actividad->id,
            'user_id' => auth()->id() ?? 1,
            'accion' => $accion,
            'detalle' => 'Actividad: ' . $actividad->codigo
        ]);
    }
}