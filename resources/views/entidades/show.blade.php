<x-app-layout>
    @section('title', 'Detalle de la Entidad')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Detalle de la Entidad') }}
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
                                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-primary">{{ $entidad->subSector }}</h1>
                                <p class="text-neutral/70 mt-1">Código: {{ $entidad->codigo }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 md:mt-0 flex space-x-3">
                            <a href="{{ route('entidades.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Volver al listado
                            </a>
                        </div>
                    </div>

                    {{-- Información principal --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        
                        {{-- Información básica --}}
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 shadow-sm border border-purple-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Información Básica</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">ID de Entidad</label>
                                    <p class="text-gray-900 font-semibold text-lg">{{ $entidad->idEntidad }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Código de Entidad</label>
                                    <p class="text-gray-900 font-mono text-base font-semibold bg-white px-3 py-1 rounded border">{{ $entidad->codigo }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Sub Sector</label>
                                    <p class="text-gray-900 font-semibold text-base mt-1">{{ $entidad->subSector }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Estado Actual</label>
                                    <div class="mt-1">
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                            @if ($entidad->estado == 'Activo') bg-green-100 text-green-800
                                            @elseif($entidad->estado == 'En Reorganización') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ $entidad->estado }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Información gubernamental --}}
                        <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-6 shadow-sm border border-indigo-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Información Gubernamental</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Nivel de Gobierno</label>
                                    <p class="text-gray-900 font-semibold">{{ $entidad->nivelGobierno }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Clasificación</label>
                                    <p class="text-gray-700">
                                        @switch($entidad->nivelGobierno)
                                            @case('Nacional')
                                                Entidad del gobierno central
                                                @break
                                            @case('Regional')
                                                Entidad de gobierno regional
                                                @break
                                            @case('Local')
                                                Entidad de gobierno local
                                                @break
                                            @default
                                                Entidad gubernamental
                                        @endswitch
                                    </p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Ámbito de Acción</label>
                                    <p class="text-gray-700">
                                        @switch($entidad->nivelGobierno)
                                            @case('Nacional')
                                                Todo el territorio nacional
                                                @break
                                            @case('Regional')
                                                Ámbito regional específico
                                                @break
                                            @case('Local')
                                                Jurisdicción local
                                                @break
                                            @default
                                                Por definir
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Información temporal --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 shadow-sm border border-green-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Fecha de Creación</h3>
                            </div>
                            <p class="text-gray-900 font-semibold text-lg">
                                {{ $entidad->fechaCreacion ? \Carbon\Carbon::parse($entidad->fechaCreacion)->format('d/m/Y') : 'No registrada' }}
                            </p>
                            @if($entidad->fechaCreacion)
                                <p class="text-gray-600 text-sm mt-1">
                                    Hace {{ \Carbon\Carbon::parse($entidad->fechaCreacion)->diffForHumans() }}
                                </p>
                            @endif
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 shadow-sm border border-blue-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Última Actualización</h3>
                            </div>
                            <p class="text-gray-900 font-semibold text-lg">
                                {{ $entidad->fechaActualizacion ? \Carbon\Carbon::parse($entidad->fechaActualizacion)->format('d/m/Y') : 'No registrada' }}
                            </p>
                            @if($entidad->fechaActualizacion)
                                <p class="text-gray-600 text-sm mt-1">
                                    Hace {{ \Carbon\Carbon::parse($entidad->fechaActualizacion)->diffForHumans() }}
                                </p>
                            @endif
                        </div>
                    </div>

                    {{-- Información contextual --}}
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 shadow-sm border border-gray-200">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Contexto de la Entidad</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center mb-4">
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold text-purple-600">🏛️</div>
                                <div class="text-sm text-gray-600">Entidad Pública</div>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold text-indigo-600">📋</div>
                                <div class="text-sm text-gray-600">{{ $entidad->nivelGobierno }}</div>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold 
                                    @if ($entidad->estado == 'Activo') text-green-600
                                    @elseif($entidad->estado == 'En Reorganización') text-yellow-600
                                    @else text-red-600 @endif">
                                    @if ($entidad->estado == 'Activo') ✅
                                    @elseif($entidad->estado == 'En Reorganización') ⚠️
                                    @else ❌ @endif
                                </div>
                                <div class="text-sm text-gray-600">{{ $entidad->estado }}</div>
                            </div>
                        </div>
                        
                        <p class="text-gray-700 text-sm text-center">
                            Las entidades son las organizaciones del sector público responsables de implementar 
                            políticas, programas y proyectos específicos dentro de su ámbito de competencia. 
                            Cada entidad opera en un nivel de gobierno determinado y mantiene programas asociados 
                            para el cumplimiento de sus objetivos institucionales.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
