<?php

namespace App\Http\Controllers;

use App\Models\Ods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::any(['view ods', 'manage ods']);
        $ods = Ods::all();
        return view('ods.index', compact('ods'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::any(['create ods', 'manage ods']);
        return redirect()->route('ods.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::any(['create ods', 'manage ods']);
        $request->validate([
            'odsnum'=> 'required|integer',
            'nombre'=> 'required|string',
            'descripcion'=> 'required|string',
        ]);

        Ods::create($request->all());

        return redirect()->route('ods.index')->with('success', 'ODS Creado Satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        Gate::any(['view ods', 'manage ods']);
        $ods = Ods::findOrFail($id);
        return view('ods.show', compact('ods'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        Gate::any(['edit ods', 'manage ods']);
        return redirect()->route('ods.index');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Gate::any(['edit ods', 'manage ods']);

        $request->validate([
            'odsnum'=> 'required|integer',
            'nombre'=> 'required|string',
            'descripcion'=> 'required|string',
        ]);

        $ods = Ods::findOrfail($id);
        $ods->update($request->all()); // error

        return redirect()->route('ods.index')->with('success', 'ODS Actualizado Satisfactoriamente');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::any(['delete ods', 'manage ods']);
        $ods = Ods::findOrfail($id);
        $ods->delete();

        return redirect()->route('ods.index')->with('success', 'ODS Eliminado Satisfactoriamente');
    }

    public function documentopdf()
    {
        Gate::any(['generate report ods', 'generate reports']);
        $ods = Ods::all();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('ods.pdf', compact('ods'));
        return $pdf->stream('ods.pdf');
    }
}
