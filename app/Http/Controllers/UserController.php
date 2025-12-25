<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::any(['view usuarios', 'manage usuarios']);
        $usuarios = User::all();
        $roles = Role::all();
        return view('usuarios.index', compact('usuarios', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::any(['create usuarios', 'manage usuarios']);
        $roles = Role::all();

        // Si es una petición AJAX, devolver JSON
        if (request()->wantsJson()) {
            return response()->json(['roles' => $roles]);
        }

        // Si no es AJAX, devolver la vista (para compatibilidad)
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::any(['create usuarios', 'manage usuarios']);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'spatie_roles' => 'required|array|min:1',
            'spatie_roles.*' => 'exists:roles,id'
        ]);

        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Asignar roles de Spatie si se proporcionaron
        if ($request->has('spatie_roles')) {
            // Convertir IDs a nombres de roles
            $roleNames = Role::whereIn('id', $request->spatie_roles)->pluck('name')->toArray();
            $usuario->assignRole($roleNames);
        }

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        Gate::any(['view usuarios', 'manage usuarios']);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        Gate::any(['edit usuarios', 'manage usuarios']);
        $roles = Role::all();
        return response()->json([
            'usuario' => $usuario,
            'roles' => $roles,
            'usuario_roles' => $usuario->roles->pluck('id')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
        Gate::any(['edit usuarios', 'manage usuarios']);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($usuario->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'spatie_roles' => 'required|array|min:1',
            'spatie_roles.*' => 'exists:roles,id'
        ]);

        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Actualizar contraseña solo si se proporcionó
        if ($request->filled('password')) {
            $usuario->update(['password' => Hash::make($request->password)]);
        }

        // Sincronizar roles de Spatie
        if ($request->has('spatie_roles')) {
            // Convertir IDs a nombres de roles
            $roleNames = Role::whereIn('id', $request->spatie_roles)->pluck('name')->toArray();
            $usuario->syncRoles($roleNames);
        } else {
            $usuario->syncRoles([]);
        }

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        Gate::any(['delete usuarios', 'manage usuarios']);
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}
