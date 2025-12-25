<?php

namespace App\Http\Controllers;

use App\Models\unidad;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;


class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::any(['view unidades', 'manage unidades']);
        $unidades = Unidad::all();
        return view('unidades.index', compact('unidades'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::any(['create unidades', 'manage unidades']);
        $unidades = Unidad::all();
        return view('unidades.create', compact('unidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::any(['create unidades', 'manage unidades']);
        $request->validate([
            'macrosector'=> 'required|string',
            'sector'=> 'required|string',
            'estado'=> 'required|string',
        ]);

        Unidad::create($request->all());

        return redirect()->route('unidades.index')->with('success', 'Unidad Creada Satisfactoriamente');
    }

    public function show($id)
    {
        Gate::any(['view unidades', 'manage unidades']);
        $unidad = Unidad::findOrFail($id);
        return view('unidades.show', compact('unidad'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        Gate::any(['edit unidades', 'manage unidades']);
        $unidades = Unidad::findOrfail($id);
        return view('unidades.edit', compact('unidades'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Gate::any(['edit unidades', 'manage unidades']);
        $request->validate([
            'macrosector'=> 'required|string',
            'sector'=> 'required|string',
            'estado'=> 'required|string',
        ]);

        $unidades = Unidad::findOrfail($id);
        $unidades->update($request->all());

        return redirect()->route('unidades.index')->with('success', 'Unidad Actualizada Satisfactoriamente');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::any(['delete unidades', 'manage unidades']);
        $unidades = Unidad::findOrfail($id);
        $unidades->delete();

         return redirect()->route('unidades.index')->with('success', 'Unidad Eliminada Satisfactoriamente');

    }

    public function documentopdf(){
        Gate::any(['generate report unidades', 'generate reports']);
        $unidad = Unidad::all();
        $pdf =Pdf::loadView('unidades.pdf', compact('unidad'));
        return $pdf->stream('reporte_unidad.pdf');
    }
}
