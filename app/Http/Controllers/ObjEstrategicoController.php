<?php

namespace App\Http\Controllers;

use App\Models\objEstrategico;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

class ObjEstrategicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::any(['view objetivos_estrategicos', 'manage objetivos_estrategicos']);
        $objEstrategicos = objEstrategico::all();
        return view('objEstrategicos.index', compact('objEstrategicos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::any(['create objetivos_estrategicos', 'manage objetivos_estrategicos']);
        return redirect()->route('objEstrategicos.index');
    }

    public function show($id)
    {
        Gate::any(['view objetivos_estrategicos', 'manage objetivos_estrategicos']);
        $objEstrategico = objEstrategico::findOrFail($id);
        return view('objEstrategicos.show', compact('objEstrategico'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::any(['create objetivos_estrategicos', 'manage objetivos_estrategicos']);
        $request->validate([
            'fechaRegistro'=> 'required|date',
            'descripcion'=> 'required|string',
            'estado'=> 'required|string',
        ]);

        objEstrategico::create($request->all());

        return redirect()->route('objEstrategicos.index')->with('success', 'Objetivo Estrategico Registrado Satisfactoriamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        Gate::any(['edit objetivos_estrategicos', 'manage objetivos_estrategicos']);
        return redirect()->route('objEstrategicos.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Gate::any(['edit objetivos_estrategicos', 'manage objetivos_estrategicos']);
        $request->validate([
            //'idobjEstrategico'=> 'integer|unique:idobjEstrategico',
            'fechaRegistro'=> 'required|date',
            'descripcion'=> 'required|string',
            'estado'=> 'required|string',
        ]);

        $objEstrategicos = objEstrategico::findOrfail($id);
        $objEstrategicos->update($request->all()); // error

        return redirect()->route('objEstrategicos.index')->with('success', 'Objetivo Estratégico Actualizado Satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::any(['delete objetivos_estrategicos', 'manage objetivos_estrategicos']);
        $objEstrategicos = objEstrategico::findOrfail($id);
        $objEstrategicos->delete();

         return redirect()->route('objEstrategicos.index')->with('success', 'Objetivo Estratégico Eliminada Satisfactoriamente');
    }

    public function documentopdf(){
        Gate::any(['generate report objetivos_estrategicos', 'generate reports']);
        $objEstrategicos = objEstrategico::all();
        $pdf =Pdf::loadView('objEstrategicos.pdf', compact('objEstrategicos'));
        return $pdf->stream('reporte_objEstrategicos.pdf');
    }
}
