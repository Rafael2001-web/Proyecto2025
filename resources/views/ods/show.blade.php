<x-app-layout>
    @section('title', 'Detalle del Objetivo ODS')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Detalle del Objetivo de Desarrollo Sostenible') }}
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
                                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-green-500 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-primary">ODS {{ $ods->odsnum }}</h1>
                                <p class="text-neutral/70 mt-1">{{ $ods->nombre }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 md:mt-0 flex space-x-3">
                            <a href="{{ route('ods.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Volver al listado
                            </a>
                        </div>
                    </div>

                    {{-- Información principal del ODS --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        
                        {{-- Información básica --}}
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 shadow-sm border border-blue-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a1.994 1.994 0 01-1.414.586H7a4 4 0 01-4-4V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Información del Objetivo</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">ID del ODS</label>
                                    <p class="text-gray-900 font-semibold text-lg">{{ $ods->idOds }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Número ODS</label>
                                    <div class="flex items-center mt-1">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            ODS {{ $ods->odsnum }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Nombre del Objetivo</label>
                                    <p class="text-gray-900 font-semibold text-base mt-1">{{ $ods->nombre }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Icono representativo del ODS --}}
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 shadow-sm border border-green-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Objetivo Global</h3>
                            </div>
                            
                            <div class="text-center">
                                <div class="w-24 h-24 bg-gradient-to-r from-blue-400 to-green-400 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                                    <span class="text-white font-bold text-2xl">{{ $ods->odsnum }}</span>
                                </div>
                                <p class="text-gray-700 text-sm">
                                    Este es el Objetivo de Desarrollo Sostenible número {{ $ods->odsnum }} de los 17 objetivos establecidos por las Naciones Unidas para transformar nuestro mundo.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Descripción completa --}}
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 shadow-sm border border-purple-200">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Descripción del Objetivo</h3>
                        </div>
                        
                        <div class="prose max-w-none">
                            <p class="text-gray-700 leading-relaxed text-justify">
                                {{ $ods->descripcion }}
                            </p>
                        </div>
                    </div>

                    {{-- Información contextual --}}
                    <div class="mt-8 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-6 shadow-sm border border-indigo-200">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Contexto de los ODS</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold text-indigo-600">17</div>
                                <div class="text-sm text-gray-600">Objetivos Globales</div>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold text-indigo-600">2030</div>
                                <div class="text-sm text-gray-600">Año Meta</div>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold text-indigo-600">193</div>
                                <div class="text-sm text-gray-600">Países Comprometidos</div>
                            </div>
                        </div>
                        
                        <p class="text-gray-700 text-sm mt-4 text-center">
                            Los Objetivos de Desarrollo Sostenible son un llamado universal a la acción para acabar con la pobreza, 
                            proteger el planeta y mejorar las vidas y perspectivas de las personas en todo el mundo.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>