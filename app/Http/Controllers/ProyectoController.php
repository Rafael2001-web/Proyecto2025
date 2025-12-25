<?php

namespace App\Http\Controllers;

use App\Models\proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::any(['view proyectos', 'manage proyectos']);
        $proyectos = Proyecto::all();
        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::any(['create proyectos', 'manage proyectos']);
        return redirect()->route('proyectos.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::any(['create proyectos', 'manage proyectos']);
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'sector' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'presupuesto' => 'required|numeric|min:0',
        ]);

        Proyecto::create([
            'codigo' => 'PRO-' . strtoupper(uniqid()),
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'sector' => $request->sector,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'presupuesto' => $request->presupuesto,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto creado correctamente');
    }
    /**
     * Display the specified resource.
     */
   public function show(Proyecto $proyecto)
    {
        Gate::any(['view proyectos', 'manage proyectos']);
        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit(Proyecto $proyecto)
    {
        Gate::any(['edit proyectos', 'manage proyectos']);
        return redirect()->route('proyectos.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        Gate::any(['edit proyectos', 'manage proyectos']);
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'sector' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'presupuesto' => 'required|numeric|min:0',
            'estado' => 'required|in:borrador,aprobado,ejecucion,completado'
        ]);

        $proyecto->update($request->all());

        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Proyecto $proyecto)
    {
        Gate::any(['delete proyectos', 'manage proyectos']);
        $proyecto->delete();
        return redirect()->route('proyectos.index')
            ->with('success', 'Proyecto eliminado correctamente');
    }
}
