<x-app-layout>
    @section('title', 'Ver Usuario')
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Detalles del Usuario') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white">
                    {{-- Botones de navegación --}}
                    <div class="flex justify-between items-center mb-6">
                        <a href="{{ route('usuarios.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Volver
                        </a>
                        
                        <div class="flex space-x-2">
                            <button onclick="openEditModal({{ json_encode($usuario) }})" 
                                    class="inline-flex items-center px-4 py-2 bg-neutral border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary active:bg-neutral focus:outline-none focus:border-neutral focus:ring ring-neutral/20 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Editar
                            </button>
                            <button onclick="openDeleteModal('{{ route('usuarios.destroy', $usuario->id) }}')" 
                                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-600 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Eliminar
                            </button>
                        </div>
                    </div>

                    {{-- Información del usuario --}}
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-center mb-6">
                            <div class="flex-shrink-0 h-20 w-20">
                                <div class="h-20 w-20 rounded-full bg-secondary flex items-center justify-center">
                                    <span class="text-white font-bold text-2xl">{{ strtoupper(substr($usuario->name, 0, 1)) }}</span>
                                </div>
                            </div>
                            <div class="ml-6">
                                <h3 class="text-2xl font-bold text-primary">{{ $usuario->name }}</h3>
                                <p class="text-neutral font-mono">{{ $usuario->email }}</p>
                                <div class="mt-2">
                                    @if($usuario->roles->count() > 0)
                                        @foreach($usuario->roles as $role)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 mr-2">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                            Sin roles asignados
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Información básica --}}
                            <div class="bg-white rounded-lg p-6 shadow-sm">
                                <h4 class="text-lg font-semibold text-primary mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Información Personal
                                </h4>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">ID del Usuario</dt>
                                        <dd class="text-sm text-gray-900 font-mono">{{ $usuario->id }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Nombre Completo</dt>
                                        <dd class="text-sm text-gray-900">{{ $usuario->name }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Correo Electrónico</dt>
                                        <dd class="text-sm text-gray-900 font-mono">{{ $usuario->email }}</dd>
                                    </div>
                                </dl>
                            </div>

                            {{-- Roles y permisos --}}
                            <div class="bg-white rounded-lg p-6 shadow-sm">
                                <h4 class="text-lg font-semibold text-primary mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    Roles y Permisos
                                </h4>
                                <div class="space-y-4">
                                    {{-- Roles asignados --}}
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 mb-2">Roles Asignados</dt>
                                        @if($usuario->roles->count() > 0)
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($usuario->roles as $role)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ $role->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-500 italic">Sin roles asignados</span>
                                        @endif
                                    </div>

                                    {{-- Permisos directos --}}
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500 mb-2">Permisos Directos</dt>
                                        @if($usuario->getDirectPermissions()->count() > 0)
                                            <div class="flex flex-wrap gap-2">
                                                @foreach($usuario->getDirectPermissions() as $permission)
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        {{ $permission->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-sm text-gray-500 italic">Sin permisos directos</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Información de fechas --}}
                        <div class="mt-6 bg-white rounded-lg p-6 shadow-sm">
                            <h4 class="text-lg font-semibold text-primary mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Información Temporal
                            </h4>
                            <dl class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Fecha de Registro</dt>
                                    <dd class="text-sm text-gray-900">{{ $usuario->created_at->format('d/m/Y H:i:s') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Última Actualización</dt>
                                    <dd class="text-sm text-gray-900">{{ $usuario->updated_at->format('d/m/Y H:i:s') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Verificación de Email</dt>
                                    <dd class="text-sm text-gray-900">
                                        @if($usuario->email_verified_at)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Verificado ({{ $usuario->email_verified_at->format('d/m/Y') }})
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                No verificado
                                            </span>
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal de edición (lo incluimos aquí para reutilizar la funcionalidad) --}}
    @include('usuarios.partials.edit-modal')

    {{-- Modal de confirmación de eliminación --}}
    @include('usuarios.partials.delete-modal')
</x-app-layout>