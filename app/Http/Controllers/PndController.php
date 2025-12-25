<?php

namespace App\Http\Controllers;

use App\Models\pnd;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;

class PndController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::any(['view pnd', 'manage pnd']);
        $pnd = Pnd::all();
        return view('pnd.index', compact('pnd'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::any(['create pnd', 'manage pnd']);
        return redirect()->route('pnd.index');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        Gate::any(['view pnd', 'manage pnd']);
        $pnd = Pnd::findOrFail($id);
        return view('pnd.show', compact('pnd'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::any(['create pnd', 'manage pnd']);
        $request->validate([
            'eje'=> 'required|string',
            'objetivoN'=> 'required|integer',
            'descripcion'=> 'required|string',
        ]);

        Pnd::create($request->all());

        return redirect()->route('pnd.index')->with('success', 'PND Creado Satisfactoriamente');


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        Gate::any(['edit pnd', 'manage pnd']);
        return redirect()->route('pnd.index');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        Gate::any(['edit pnd', 'manage pnd']);
        $request->validate([
            'eje'=> 'required|string',
            'objetivoN'=> 'required|integer',
            'descripcion'=> 'required|string',
        ]);

        $pnd = Pnd::findOrfail($id);
        $pnd->update($request->all()); // error

        return redirect()->route('pnd.index')->with('success', 'PND Actualizado Satisfactoriamente');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gate::any(['delete pnd', 'manage pnd']);
        $pnd = Pnd::findOrfail($id);
        $pnd->delete();

         return redirect()->route('pnd.index')->with('success', 'ODS Eliminado Satisfactoriamente');
    }

    public function documentopdf(){
        Gate::any(['generate report pnd', 'generate reports']);
        $pnd = Pnd::all();
        $pdf =Pdf::loadView('pnd.pdf', compact('pnd'));
        return $pdf->stream('reporte_pnd.pdf');
    }
}
