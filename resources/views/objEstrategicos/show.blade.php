<x-app-layout>
    @section('title', 'Detalle del Objetivo Estratégico')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Detalle del Objetivo Estratégico') }}
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-primary">Objetivo Estratégico</h1>
                                <p class="text-neutral/70 mt-1">ID: {{ $objEstrategico->idobjEstrategico }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 md:mt-0 flex space-x-3">
                            <a href="{{ route('objEstrategicos.index') }}" 
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
                            @if ($objEstrategico->estado == 'activo') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($objEstrategico->estado) }}
                        </span>
                    </div>

                    {{-- Información del objetivo --}}
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
                                    <label class="text-sm font-medium text-gray-600">ID del Objetivo</label>
                                    <p class="text-gray-900 font-semibold text-lg">{{ $objEstrategico->idobjEstrategico }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Fecha de Registro</label>
                                    <p class="text-gray-900 font-semibold">{{ \Carbon\Carbon::parse($objEstrategico->fechaRegistro)->format('d/m/Y') }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Estado Actual</label>
                                    <div class="mt-1">
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                                            @if ($objEstrategico->estado == 'activo') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst($objEstrategico->estado) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Contexto estratégico --}}
                        <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-6 shadow-sm border border-indigo-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Contexto Estratégico</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Tipo de Objetivo</label>
                                    <p class="text-gray-900">Objetivo Estratégico Organizacional</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Nivel de Impacto</label>
                                    <p class="text-gray-700">Alto nivel - Orientación estratégica institucional</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Alcance</label>
                                    <p class="text-gray-700">Transversal a toda la organización</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Descripción completa --}}
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 shadow-sm border border-green-200">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Descripción del Objetivo</h3>
                        </div>
                        
                        <div class="prose max-w-none">
                            <p class="text-gray-700 leading-relaxed text-justify">
                                {{ $objEstrategico->descripcion }}
                            </p>
                        </div>
                    </div>

                    {{-- Información adicional --}}
                    <div class="mt-8 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 shadow-sm border border-gray-200">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Importancia Estratégica</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold text-purple-600">
                                    @if ($objEstrategico->estado == 'activo') ✓ @else ⚠ @endif
                                </div>
                                <div class="text-sm text-gray-600">Estado del Objetivo</div>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold text-indigo-600">{{ \Carbon\Carbon::parse($objEstrategico->fechaRegistro)->diffInDays(\Carbon\Carbon::now()) }}</div>
                                <div class="text-sm text-gray-600">Días desde registro</div>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold text-green-600">📋</div>
                                <div class="text-sm text-gray-600">Seguimiento Activo</div>
                            </div>
                        </div>
                        
                        <p class="text-gray-700 text-sm mt-4 text-center">
                            Los objetivos estratégicos son fundamentales para el direccionamiento y enfoque organizacional,
                            permitiendo alinear todos los esfuerzos institucionales hacia metas comunes de largo plazo.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
