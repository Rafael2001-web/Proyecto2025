<?php

namespace App\Http\Controllers;

use App\Models\ObjetivoInstitucional;
use App\Models\Pnd;
use App\Models\Ods;
use App\Models\objEstrategico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ObjetivoInstitucionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::any(['view strategic alignment', 'manage strategic alignment']);
        $objetivos = ObjetivoInstitucional::with(['pnd', 'ods', 'objetivoEstrategico'])->get();
        $pnds = Pnd::all();
        $odss = Ods::all();
        $objetivosEstrategicos = objEstrategico::all();

        return view('objetivos-institucionales.index', compact('objetivos', 'pnds', 'odss', 'objetivosEstrategicos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::any(['create strategic alignment', 'manage strategic alignment']);
        return redirect()->route('objetivos-institucionales.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::any(['create strategic alignment', 'manage strategic alignment']);
        $request->validate([
            'idPnd' => 'required|exists:pnd,idPnd',
            'idOds' => 'required|exists:ods,idOds',
            'idobjEstrategico' => 'required|exists:objestrategicos,idobjEstrategico',
            'nivel_alineacion' => 'required|in:Alto,Medio,Bajo',
            'justificacion' => 'nullable|string',
        ]);

        ObjetivoInstitucional::create($request->all());

        return redirect()->route('objetivos-institucionales.index')
                        ->with('success', 'Objetivo Institucional creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        Gate::any(['view strategic alignment', 'manage strategic alignment']);
        $objetivo = ObjetivoInstitucional::with(['pnd', 'ods', 'objetivoEstrategico'])->findOrFail($id);

        return view('objetivos-institucionales.show', compact('objetivo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        Gate::any(['edit strategic alignment', 'manage strategic alignment']);
        return redirect()->route('objetivos-institucionales.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Gate::any(['edit strategic alignment', 'manage strategic alignment']);
        $request->validate([
            'idPnd' => 'required|exists:pnd,idPnd',
            'idOds' => 'required|exists:ods,idOds',
            'idobjEstrategico' => 'required|exists:objestrategicos,idobjEstrategico',
            'nivel_alineacion' => 'required|in:Alto,Medio,Bajo',
            'justificacion' => 'nullable|string',
        ]);

        $objetivo = ObjetivoInstitucional::findOrFail($id);
        $objetivo->update($request->all());

        return redirect()->route('objetivos-institucionales.index')
                        ->with('success', 'Objetivo Institucional actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::any(['delete strategic alignment', 'manage strategic alignment']);
        $objetivo = ObjetivoInstitucional::findOrFail($id);
        $objetivo->delete();

        return redirect()->route('objetivos-institucionales.index')
                        ->with('success', 'Objetivo Institucional eliminado satisfactoriamente');
    }

    public function documentopdf()
    {
        Gate::any(['generate report objetivos_institucionales', 'generate reports']);
        $objetivos = ObjetivoInstitucional::with(['pnd', 'ods', 'objetivoEstrategico'])->get();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('objetivos-institucionales.pdf', compact('objetivos'));
        return $pdf->stream('objetivos-institucionales.pdf');
    }
}