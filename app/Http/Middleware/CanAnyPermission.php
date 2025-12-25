<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanAnyPermission
{
    /**
     * Handle an incoming request.
     * Permite el acceso si el usuario tiene CUALQUIERA de los permisos especificados
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$permissions  Lista de permisos separados por comas
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        $user = $request->user();
        
        if (!$user) {
            abort(403, 'Usuario no autenticado');
        }

        // Verificar si el usuario tiene AL MENOS UNO de los permisos
        foreach ($permissions as $permission) {
            if ($user->can($permission)) {
                return $next($request);
            }
        }

        abort(403, 'No tienes permisos para acceder a esta sección');
    }
}
