<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntidadController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ObjEstrategicoController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\OdsController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\PndController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ObjetivoInstitucionalController;
use App\Http\Controllers\ActividadController;

/*

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Ruta pública
Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

//Rutas para los perfiles
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==================================================================================
    // RUTAS INDEX 
    // ==================================================================================

    // 👑 ADMINISTRADOR DEL SISTEMA - Ver listados de usuarios
    Route::middleware('can.any:view usuarios,manage usuarios')->group(function () {
        Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/{usuario}', [UserController::class, 'show'])->name('usuarios.show');
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/roles/{role}', [RoleController::class, 'show'])->name('roles.show');
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/permissions/{permission}', [PermissionController::class, 'show'])->name('permissions.show');
    });

    //🏗️ ACTIVIDADES - Ver listado de Actividades
    Route::middleware('can.any:view actividades,manage actividades')->group(function () {
        Route::get('/actividades', [ActividadController::class, 'index'])->name('actividades.index');
        Route::get('/actividades/{actividad}', [ActividadController::class, 'show'])->name('actividades.show');
    });

    // 🏢 GESTOR DE ENTIDADES - Ver listado de entidades
    Route::middleware('can.any:view entidades,manage entidades')->group(function () {
        Route::get('/entidades', [EntidadController::class, 'index'])->name('entidades.index');
        Route::get('/entidades/{entidad}', [EntidadController::class, 'show'])->name('entidades.show');
    });

    // 🏗️ UNIDADES - Ver listado de unidades
    Route::middleware('can.any:view unidades,manage unidades')->group(function () {
        Route::get('/unidades', [UnidadController::class, 'index'])->name('unidades.index');
        Route::get('/unidades/{unidad}', [UnidadController::class, 'show'])->name('unidades.show');
    });

    // 🎯 ODS - Ver listado de ODS
    Route::middleware('can.any:view ods,manage ods')->group(function () {
        Route::get('/ods', [OdsController::class, 'index'])->name('ods.index');
        Route::get('/ods/{ods}', [OdsController::class, 'show'])->name('ods.show');
    });

    // 🎯 PLANIFICADOR ESTRATÉGICO - Ver listado de objetivos estratégicos
    Route::middleware('can.any:view objetivos_estrategicos,manage objetivos_estrategicos')->group(function () {
        Route::get('/objEstrategicos', [ObjEstrategicoController::class, 'index'])->name('objEstrategicos.index');
        Route::get('/objEstrategicos/{objEstrategico}', [ObjEstrategicoController::class, 'show'])->name('objEstrategicos.show');
    });

    // 🇵🇪 ANALISTA DE PND - Ver listado de PND
    Route::middleware('can.any:view pnd,manage pnd')->group(function () {
        Route::get('/pnd', [PndController::class, 'index'])->name('pnd.index');
        Route::get('/pnd/{pnd}', [PndController::class, 'show'])->name('pnd.show');
    });

    // 🎯 OBJETIVOS INSTITUCIONALES - Ver listado de objetivos institucionales
    Route::middleware('can.any:view strategic alignment,manage strategic alignment')->group(function () {
        Route::get('/objetivos-institucionales', [ObjetivoInstitucionalController::class, 'index'])->name('objetivos-institucionales.index');
        Route::get('/objetivos-institucionales/{objetivo}', [ObjetivoInstitucionalController::class, 'show'])->name('objetivos-institucionales.show');
    });

    // 📋 PLANES - Ver listado de planes
    Route::middleware('can.any:view planes,manage planes')->group(function () {
        Route::get('/planes', [PlanController::class, 'index'])->name('planes.index');
        Route::get('/planes/{plan}', [PlanController::class, 'show'])->name('planes.show');
    });

    Route::put('/planes/{plan}/estado', [PlanController::class, 'estado'])->name('planes.estado')->middleware('can:cambiar estado planes');

    // 📊 PROGRAMAS - Ver listado de programas
    Route::middleware('can.any:view programas,manage programas')->group(function () {
        Route::get('/programas', [ProgramaController::class, 'index'])->name('programas.index');
        Route::get('/programas/{programa}', [ProgramaController::class, 'show'])->name('programas.show');
    });

    // 📈 ANALISTA DE PROYECTOS - Ver listado de proyectos
    Route::middleware('can.any:view proyectos,manage proyectos')->group(function () {
        Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
        Route::get('/proyectos/{proyecto}', [ProyectoController::class, 'show'])->name('proyectos.show');
    });

    // ==================================================================================
    // RUTAS CRUD - Gestión COMPLETA (manage permissions only)
    // ==================================================================================

    // 👑 ADMINISTRADOR DEL SISTEMA - Gestión completa de usuarios
    Route::middleware('can.any:manage usuarios, create usuarios, edit usuarios, delete usuarios')->group(function () {
        Route::resource('usuarios', UserController::class)->except(['index', 'show']);
        Route::resource('roles', RoleController::class)->except(['index', 'show']);
        Route::resource('permissions', PermissionController::class)->except(['index', 'show']);
    });


    // 🎯 ACTIVIDADES - CRUD completo de actividades
     Route::middleware('can.any:manage actividades, create actividades, edit actividades, delete actividades')->group(function () {
        Route::resource('actividades', ActividadController::class)->except(['index', 'show', 'create', 'edit']);
    });

    // 🏢 GESTOR DE ENTIDADES - CRUD completo de entidades
    Route::middleware('can.any:manage entidades, create entidades, edit entidades, delete entidades')->group(function () {
        Route::resource('entidades', EntidadController::class)->except(['index', 'show']);
    });

    // 🏗️  UNIDADES - CRUD completo de unidades
    Route::middleware('can.any:manage unidades, create unidades, edit unidades, delete unidades')->group(function () {
        Route::resource('unidades', UnidadController::class)->except(['index', 'show']);
    });

    // 🎯 ODS - CRUD completo de ODS
    Route::middleware('can.any:manage ods, create ods, edit ods, delete ods')->group(function () {
        Route::resource('ods', OdsController::class)->except(['index', 'show']);
    });

    // 🎯 PLANIFICADOR ESTRATÉGICO - CRUD completo de objetivos estratégicos
    Route::middleware('can.any:manage objetivos_estrategicos, create objetivos_estrategicos, edit objetivos_estrategicos, delete objetivos_estrategicos')->group(function () {
        Route::resource('objEstrategicos', ObjEstrategicoController::class)->except(['index', 'show']);
    });

    //  ANALISTA DE PND - CRUD completo de PND
    Route::middleware('can.any:manage pnd, create pnd, edit pnd, delete pnd')->group(function () {
        Route::resource('pnd', PndController::class)->except(['index', 'show']);
    });

    // 🎯 OBJETIVOS INSTITUCIONALES - CRUD completo de alineación estratégica
    Route::middleware('can.any:manage strategic alignment, create strategic alignment, edit strategic alignment, delete strategic alignment')->group(function () {
        Route::resource('objetivos-institucionales', ObjetivoInstitucionalController::class)->except(['index', 'show']);
    });

    // 📋 PLANES - CRUD completo de planes
    Route::middleware('can.any:manage planes, create planes, edit planes, delete planes')->group(function () {
        Route::resource('planes', PlanController::class)->except(['index', 'show']);
    });

    // 📊 PROGRAMAS - CRUD completo de programas
    Route::middleware('can.any:manage programas, create programas, edit programas, delete programas')->group(function () {
        Route::resource('programas', ProgramaController::class)->except(['index', 'show']);
    });

    // 📈 PROYECTOS - CRUD completo de proyectos
    Route::middleware('can.any:manage proyectos, create proyectos, edit proyectos, delete proyectos')->group(function () {
        Route::resource('proyectos', ProyectoController::class)->except(['index', 'show']);
    });

    // RUTAS DE REPORTES 
    // permiso generate reports
    Route::middleware('can.any:generate reports, generate report entidades, generate report programas, generate report proyectos, generate report unidades, generate report objEstrategicos, generate report pnd, generate report planes')->prefix('reportes')->group(function () {
        Route::get('/entidades/pdf', [EntidadController::class, 'documentopdf'])->name('entidades.documentopdf');
        Route::get('/programas/pdf', [ProgramaController::class, 'documentopdf'])->name('programas.documentopdf');
        Route::get('/proyectos/pdf', [ProyectoController::class, 'documentopdf'])->name('proyectos.documentopdf');
        Route::get('/unidades/pdf', [UnidadController::class, 'documentopdf'])->name('unidades.documentopdf');
        Route::get('/objEstrategicos/pdf', [ObjEstrategicoController::class, 'documentopdf'])->name('objEstrategicos.documentopdf');
        Route::get('/pnd/pdf', [PndController::class, 'documentopdf'])->name('pnd.documentopdf');
        Route::get('/planes/pdf', [PlanController::class, 'documentopdf'])->name('planes.documentopdf');
        Route::get('/ods/pdf', [OdsController::class, 'documentopdf'])->name('ods.documentopdf');
        Route::get('/objetivos-institucionales/pdf', [ObjetivoInstitucionalController::class, 'documentopdf'])->name('objetivos-institucionales.documentopdf');
        Route::get('/actividades/pdf', [ActividadController::class, 'documentopdf'])->name('actividades.documentopdf');
    });
});


// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Registro (si lo usas)
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

// (Opcional) Reset de contraseña…
require __DIR__ . '/auth.php';
