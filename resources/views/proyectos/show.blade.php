<x-app-layout>
    @section('title', 'Detalle del Proyecto')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Detalle del Proyecto') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white">
                    
                    {{-- Header con acciones --}}
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-to-r from-secondary to-accent rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-primary">{{ $proyecto->nombre }}</h1>
                                <p class="text-neutral/70 mt-1">Código: {{ $proyecto->codigo }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 md:mt-0 flex space-x-3">
                            <a href="{{ route('proyectos.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Volver al listado
                            </a>
                        </div>
                    </div>

                    {{-- Estado badge --}}
                    <div class="mb-6">
                        <span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full transition-colors duration-150
                            @if ($proyecto->estado == 'aprobado') bg-accent/20 text-primary
                            @elseif($proyecto->estado == 'En Ejecución') bg-amber-100 text-amber-800
                            @elseif($proyecto->estado == 'completado') bg-secondary/20 text-primary
                            @elseif($proyecto->estado == 'planificado') bg-blue-100 text-blue-800
                            @elseif($proyecto->estado == 'cancelado') bg-red-100 text-red-800
                            @else bg-neutral/20 text-neutral @endif">
                            {{ ucfirst($proyecto->estado) }}
                        </span>
                    </div>

                    {{-- Información del proyecto --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        {{-- Información básica --}}
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 shadow-sm border border-gray-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Información Básica</h3>
                            </div>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Código</label>
                                    <p class="text-gray-900 font-semibold">{{ $proyecto->codigo }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Nombre</label>
                                    <p class="text-gray-900 font-semibold">{{ $proyecto->nombre }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Sector</label>
                                    <p class="text-gray-900">{{ $proyecto->sector }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Información financiera --}}
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 shadow-sm border border-green-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Información Financiera</h3>
                            </div>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Presupuesto Asignado</label>
                                    <p class="text-2xl font-bold text-green-700">${{ number_format($proyecto->presupuesto, 2) }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Información temporal --}}
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 shadow-sm border border-purple-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Cronograma</h3>
                            </div>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Fecha de Inicio</label>
                                    <p class="text-gray-900 font-semibold">{{ $proyecto->fecha_inicio ? \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('d/m/Y') : 'No definida' }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Fecha de Fin</label>
                                    <p class="text-gray-900 font-semibold">{{ $proyecto->fecha_fin ? \Carbon\Carbon::parse($proyecto->fecha_fin)->format('d/m/Y') : 'No definida' }}</p>
                                </div>
                                
                                @if($proyecto->fecha_inicio && $proyecto->fecha_fin)
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Duración</label>
                                    <p class="text-gray-900">{{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->diffInDays(\Carbon\Carbon::parse($proyecto->fecha_fin)) }} días</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Información adicional --}}
                    <div class="mt-8">
                        <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-6 shadow-sm border border-indigo-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Descripción del Proyecto</h3>
                            </div>
                            
                            <div>
                                <p class="text-gray-700 leading-relaxed">{{ $proyecto->descripcion ?: 'No hay descripción disponible.' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Responsable --}}
                    @if($proyecto->user)
                    <div class="mt-8">
                        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6 shadow-sm border border-orange-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Usuario Responsable</h3>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-secondary flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ strtoupper(substr($proyecto->user->name, 0, 1)) }}</span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-gray-900 font-semibold">{{ $proyecto->user->name }}</p>
                                    <p class="text-gray-500 text-sm">{{ $proyecto->user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>