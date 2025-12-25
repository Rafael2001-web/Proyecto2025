<?php

namespace App\Http\Controllers;

use App\Models\Entidad;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;
use Ramsey\Uuid\Type\Integer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

class EntidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::any(['view entidades', 'manage entidades']);
        $entidades = Entidad::all();
        return view('entidades.index', compact('entidades'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::any(['create entidades', 'manage entidades']);
        return view('entidades.create');
    }

    public function show($id)
    {
        Gate::any(['view entidades', 'manage entidades']);
        $entidad = Entidad::findOrFail($id);
        return view('entidades.show', compact('entidad'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::any(['create entidades', 'manage entidades']);
        $request->validate([
            'codigo'=> 'required|integer|unique:entidad,codigo',
            'subSector'=> 'required|string',
            'nivelGobierno'=> 'required|string',
            'estado'=> 'required|string',
            'fechaCreacion'=> 'required|date',
            'fechaActualizacion'=> 'nullable|date',
        ]);

        Entidad::create($request->all());

        return redirect()->route('entidades.index')->with('success', 'Entidad Creada Satisfactoriamente');


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {Gate::any(['edit entidades', 'manage entidades']);
        $entidad = Entidad::findOrfail($id);
        return view('entidades.edit', compact('entidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Gate::any(['edit entidades', 'manage entidades']);
        $request->validate([
            'codigo'=> 'required|integer|unique:entidad,codigo,'.$id.',idEntidad', // error
            'subSector'=> 'required|string',
            'nivelGobierno'=> 'required|string',
            'estado'=> 'required|string',
            'fechaCreacion'=> 'required|date',
            'fechaActualizacion'=> 'nullable|date',
        ]);

        $entidad = Entidad::findOrfail($id);
        $entidad->update($request->all()); // error

        return redirect()->route('entidades.index')->with('success', 'Entidad Actualizada Satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::any(['delete entidades', 'manage entidades']);
        $entidad = Entidad::findOrfail($id);
        $entidad->delete();

         return redirect()->route('entidades.index')->with('success', 'Entidad Eliminada Satisfactoriamente');
    }

    /**
     * Generate PDF report of all entities.
     */
    public function documentopdf()
    {
        Gate::any(['generate report entidades', 'generate reports']);
        $entidades = Entidad::all();
        $pdf = Pdf::loadView('entidades.pdf', compact('entidades'));
        return $pdf->stream('reporte_entidades.pdf');
    }

}
