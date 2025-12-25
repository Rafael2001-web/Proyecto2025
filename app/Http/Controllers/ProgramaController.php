<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use App\Models\Entidad;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::any(['view programas', 'manage programas']);
        $programas = Programa::all();
        return view('programas.index', compact('programas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::any(['create programas', 'manage programas']);
        return redirect()->route('programas.index');
    }    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::any(['create programas', 'manage programas']);
        $request->validate([
            'idEntidad'=> 'required|exists:entidad,idEntidad',
            'nombre'=> 'required|string',
            'descripcion'=> 'nullable|string',
        ]);

        Programa::create($request->all());

        return redirect()->route('programas.index')->with('success', 'Programa Creado Satisfactoriamente');


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        Gate::any(['edit programas', 'manage programas']);
        return redirect()->route('programas.index');
    }    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Gate::any(['edit programas', 'manage programas']);
        $request->validate([
            'idEntidad'=> 'required|exists:entidad,idEntidad',
            'nombre'=> 'required|string',
            'descripcion'=> 'nullable|string',
        ]);

        $programa = Programa::findOrfail($id);
        $programa->update($request->all());

        return redirect()->route('programas.index')->with('success', 'Programa Actualizada Satisfactoriamente');
    }

    public function show($id)
    {
        Gate::any(['view programas', 'manage programas']);
        $programa = Programa::with('entidad')->findOrFail($id);
        return view('programas.show', compact('programa'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::any(['delete programas', 'manage programas']);
        $programa = Programa::findOrfail($id);
        $programa->delete();

         return redirect()->route('programas.index')->with('success', 'Programa Eliminada Satisfactoriamente');
    }

    public function documentopdf(){
        Gate::any(['generate report programas', 'generate reports']);
        $programa = Programa::all();
        $pdf =Pdf::loadView('programas.pdf', compact('programa'));
        return $pdf->stream('reporte_programa.pdf');
    }
}
