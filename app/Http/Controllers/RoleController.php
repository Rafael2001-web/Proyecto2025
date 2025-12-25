<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        
        // Si es una petición AJAX, devolver JSON
        if (request()->wantsJson()) {
            return response()->json(['permissions' => $permissions]);
        }
        
        // Si no es AJAX, devolver la vista (para compatibilidad)
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        // Asignar permisos si se proporcionaron
        if ($request->has('permissions')) {
            $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->givePermissionTo($permissionNames);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Rol creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role->load('permissions');
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return response()->json([
            'role' => $role,
            'permissions' => $permissions,
            'role_permissions' => $role->permissions->pluck('id')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles')->ignore($role->id),
            ],
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        // Sincronizar permisos
        if ($request->has('permissions')) {
            $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissionNames);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Rol actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Verificar si el rol está siendo usado por usuarios
        if ($role->users()->count() > 0) {
            return redirect()->route('roles.index')
                ->with('error', 'No se puede eliminar el rol porque está asignado a usuarios.');
        }

        $role->delete();
        
        return redirect()->route('roles.index')
            ->with('success', 'Rol eliminado exitosamente.');
    }
}