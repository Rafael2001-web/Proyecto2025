<?php

namespace App\Http\Controllers;

use App\Models\plan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::any(['view planes', 'manage planes']);
        $planes = Plan::all();
        return view('planes.index', compact('planes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::any(['create planes', 'manage planes']);
        return redirect()->route('planes.index');
    }


    public function show($id)
    {
        Gate::any(['view planes', 'manage planes']);
        $plan = Plan::findOrFail($id);
        return view('planes.show', compact('plan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::any(['create planes', 'manage planes']);
        $request->validate([

            'nombre'=> 'required|string',
            'entidad'=> 'required|string',
            'presupuesto' => 'required|numeric|min:0',
            'fecha_inicio'=> 'required|date',
            'fecha_fin'=> 'nullable|date',
            'estado'=> 'required|string',
        ]);

        Plan::create($request->all());

        return redirect()->route('planes.index')->with('success', 'Plan Creado Satisfactoriamente');


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        Gate::any(['edit planes', 'manage planes']);
        return redirect()->route('planes.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Gate::any(['edit planes', 'manage planes']);
        $request->validate([

            'nombre'=> 'required|string',
            'entidad'=> 'required|string',
            'presupuesto' => 'required|numeric|min:0',
            'fecha_inicio'=> 'required|date',
            'fecha_fin'=> 'nullable|date',
            'estado'=> 'required|string',
        ]);

        $plan = Plan::findOrfail($id);
        $plan->update($request->all()); // error

        return redirect()->route('planes.index')->with('success', 'Plan Actualizado Satisfactoriamente');
    }

    public function estado(Request $request, $id)
    {
        Gate::any(['cambiar estado planes', 'manage planes']);
        $request->validate([
            'estado'=> 'required|string',
        ]);

        $plan = Plan::findOrfail($id);
        $plan->update($request->only('estado'));

        return redirect()->route('planes.index')->with('success', 'Estado del Plan Actualizado Satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::any(['delete planes', 'manage planes']);
        $plan = Plan::findOrfail($id);
        $plan->delete();

         return redirect()->route('planes.index')->with('success', 'Plan Eliminado Satisfactoriamente');

    }

    public function documentopdf(){
        Gate::any(['generate report planes', 'generate reports']);
        $plan = Plan::all();
        $pdf =Pdf::loadView('Planes.pdf', compact('plan'));
        return $pdf->stream('reporte_planes.pdf');
    }
}
