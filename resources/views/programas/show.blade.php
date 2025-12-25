<x-app-layout>
    @section('title', 'Detalle del Programa')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Detalle del Programa') }}
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
                                <div class="w-16 h-16 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-primary">{{ $programa->nombre }}</h1>
                                <p class="text-neutral/70 mt-1">ID: {{ $programa->idPrograma }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 md:mt-0 flex space-x-3">
                            <a href="{{ route('programas.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Volver al listado
                            </a>
                        </div>
                    </div>

                    {{-- Información del programa --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        
                        {{-- Información básica --}}
                        <div class="bg-gradient-to-br from-cyan-50 to-cyan-100 rounded-xl p-6 shadow-sm border border-cyan-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-cyan-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Información del Programa</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">ID del Programa</label>
                                    <p class="text-gray-900 font-semibold text-lg">{{ $programa->idPrograma }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Nombre del Programa</label>
                                    <p class="text-gray-900 font-semibold text-base mt-1">{{ $programa->nombre }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Estado</label>
                                    <div class="mt-1">
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Activo
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Información de la entidad --}}
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 shadow-sm border border-blue-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Entidad Responsable</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Entidad</label>
                                    <p class="text-gray-900 font-semibold">{{ $programa->entidad->subSector ?? 'No asignada' }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">ID de Entidad</label>
                                    <p class="text-gray-700">{{ $programa->idEntidad }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Relación</label>
                                    <p class="text-gray-700">Programa adscrito a la entidad</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Descripción completa --}}
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 shadow-sm border border-green-200 mb-8">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Descripción del Programa</h3>
                        </div>
                        
                        <div class="prose max-w-none">
                            <p class="text-gray-700 leading-relaxed text-justify">
                                {{ $programa->descripcion }}
                            </p>
                        </div>
                    </div>

                    {{-- Información contextual --}}
                    <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-6 shadow-sm border border-indigo-200">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Características del Programa</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center mb-4">
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold text-cyan-600">📋</div>
                                <div class="text-sm text-gray-600">Programa Institucional</div>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold text-blue-600">🏢</div>
                                <div class="text-sm text-gray-600">Vinculado a Entidad</div>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold text-green-600">✅</div>
                                <div class="text-sm text-gray-600">Estado Activo</div>
                            </div>
                        </div>
                        
                        <p class="text-gray-700 text-sm text-center">
                            Los programas son iniciativas institucionales específicas que contribuyen al logro de los objetivos 
                            estratégicos de las entidades. Cada programa está diseñado para abordar necesidades particulares 
                            y generar impacto en la gestión pública.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
