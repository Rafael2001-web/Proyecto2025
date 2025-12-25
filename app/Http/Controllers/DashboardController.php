<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $numEntidades = \App\Models\Entidad::count();
        $numUsuarios = \App\Models\User::count();
        $numProgramas = \App\Models\Programa::count();
        $numProyectos = \App\Models\Proyecto::count();
        return view('dashboard', compact('numEntidades', 'numUsuarios', 'numProgramas', 'numProyectos'));
    }
}
