<x-app-layout>
    @section('title', 'Detalles del Permiso')
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Detalles del Permiso') }}: {{ $permission->name }}
            </h2>
            <a href="{{ route('permissions.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-white border border-transparent rounded-md font-semibold text-xs text-primary uppercase tracking-widest hover:bg-gray-100 active:bg-gray-200 focus:outline-none focus:border-gray-300 focus:ring ring-gray-200 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Volver a Permisos
            </a>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    
                    {{-- Información básica del permiso --}}
                    <div class="mb-8">
                        <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-16 w-16 rounded-full bg-green-500 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m0 0a2 2 0 01-2 2m2-2h3m-3 0h-3m-2-4.5v9"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-6">
                                    <h1 class="text-2xl font-bold text-gray-900">{{ $permission->name }}</h1>
                                    <p class="text-green-600 mt-1">
                                        Permiso del sistema • ID: {{ $permission->id }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-2">
                                        Creado el {{ $permission->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Estadísticas --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white rounded-lg shadow border p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-2xl font-semibold text-gray-900">{{ $permission->roles->count() }}</p>
                                    <p class="text-sm text-gray-600">Roles Asignados</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow border p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-2xl font-semibold text-gray-900">{{ $permission->roles->sum(function($role) { return $role->users->count(); }) }}</p>
                                    <p class="text-sm text-gray-600">Usuarios con Acceso</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow border p-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-2xl font-semibold text-gray-900">{{ $permission->created_at->diffForHumans() }}</p>
                                    <p class="text-sm text-gray-600">Última Actualización</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Roles asignados --}}
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Roles que Tienen Este Permiso</h3>
                        @if($permission->roles->count() > 0)
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                                <ul class="divide-y divide-gray-200">
                                    @foreach($permission->roles as $role)
                                        <li class="px-6 py-4">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <div class="h-10 w-10 rounded-full bg-purple-500 flex items-center justify-center">
                                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $role->name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $role->users->count() }} usuarios asignados</div>
                                                    </div>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                        {{ $role->permissions->count() }} permisos
                                                    </span>
                                                    <a href="{{ route('roles.show', $role->id) }}" 
                                                       class="text-primary hover:text-secondary font-medium text-sm">
                                                        Ver detalles
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <div class="flex">
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-800">
                                            Este permiso no está asignado a ningún rol actualmente.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Usuarios que tienen acceso indirectamente --}}
                    @if($permission->roles->count() > 0)
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Usuarios con Acceso a Este Permiso</h3>
                        @php
                            $usersWithPermission = collect();
                            foreach($permission->roles as $role) {
                                $usersWithPermission = $usersWithPermission->merge($role->users);
                            }
                            $uniqueUsers = $usersWithPermission->unique('id');
                        @endphp
                        
                        @if($uniqueUsers->count() > 0)
                            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                                <ul class="divide-y divide-gray-200">
                                    @foreach($uniqueUsers as $user)
                                        <li class="px-6 py-4">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <div class="h-10 w-10 rounded-full bg-secondary flex items-center justify-center">
                                                            <span class="text-white font-semibold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                                    </div>
                                                </div>
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($user->roles->intersect($permission->roles) as $role)
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                            vía {{ $role->name }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>