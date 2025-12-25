<x-app-layout>
    @section('title', 'Detalle Objetivo Institucional')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Objetivo Institucional - Detalle') }}
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
                                <div class="w-16 h-16 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-primary">Objetivo Institucional #{{ $objetivo->idObjInstitucional }}</h1>
                                <p class="text-neutral/70 mt-1">Alineación Estratégica Triple</p>
                            </div>
                        </div>

                        <div class="mt-4 md:mt-0 flex space-x-3">
                            <a href="{{ route('objetivos-institucionales.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Volver al listado
                            </a>
                        </div>
                    </div>

                    {{-- Nivel de Alineación --}}
                    <div class="mb-8">
                        <div class="bg-gradient-to-r from-accent/10 to-secondary/10 rounded-xl p-6 border-l-4
                            @if($objetivo->nivel_alineacion == 'Alto') border-green-500
                            @elseif($objetivo->nivel_alineacion == 'Medio') border-yellow-500
                            @else border-red-500
                            @endif">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-neutral/70 mb-1">Nivel de Alineación</p>
                                    <h3 class="text-2xl font-bold
                                        @if($objetivo->nivel_alineacion == 'Alto') text-green-600
                                        @elseif($objetivo->nivel_alineacion == 'Medio') text-yellow-600
                                        @else text-red-600
                                        @endif">
                                        {{ $objetivo->nivel_alineacion }}
                                    </h3>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                                        @if($objetivo->nivel_alineacion == 'Alto') bg-green-100 text-green-800
                                        @elseif($objetivo->nivel_alineacion == 'Medio') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        @if($objetivo->nivel_alineacion == 'Alto') ✓✓✓
                                        @elseif($objetivo->nivel_alineacion == 'Medio') ✓✓
                                        @else ✓
                                        @endif
                                        Alineación {{ $objetivo->nivel_alineacion }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Triple Alineación --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

                        {{-- PND --}}
                        <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 shadow-sm border border-red-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Plan Nacional de Desarrollo</h3>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <label class="text-xs font-medium text-gray-600">Eje Estratégico</label>
                                    <p class="text-gray-900 font-semibold">{{ $objetivo->pnd->eje ?? 'N/A' }}</p>
                                </div>

                                <div>
                                    <label class="text-xs font-medium text-gray-600">Objetivo Nacional</label>
                                    <p class="text-gray-900 font-medium">Objetivo {{ $objetivo->pnd->objetivoN ?? 'N/A' }}</p>
                                </div>

                                <div>
                                    <label class="text-xs font-medium text-gray-600">Descripción</label>
                                    <p class="text-gray-700 text-sm">{{ Str::limit($objetivo->pnd->descripcion ?? 'N/A', 100) }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- ODS --}}
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 shadow-sm border border-blue-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">ODS Agenda 2030</h3>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <label class="text-xs font-medium text-gray-600">Número ODS</label>
                                    <p class="text-gray-900 font-bold text-xl">ODS {{ $objetivo->ods->odsnum ?? 'N/A' }}</p>
                                </div>

                                <div>
                                    <label class="text-xs font-medium text-gray-600">Nombre</label>
                                    <p class="text-gray-900 font-semibold">{{ $objetivo->ods->nombre ?? 'N/A' }}</p>
                                </div>

                                <div>
                                    <label class="text-xs font-medium text-gray-600">Descripción</label>
                                    <p class="text-gray-700 text-sm">{{ Str::limit($objetivo->ods->descripcion ?? 'N/A', 100) }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Objetivo Estratégico --}}
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 shadow-sm border border-green-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Objetivo Estratégico</h3>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <label class="text-xs font-medium text-gray-600">ID</label>
                                    <p class="text-gray-900 font-semibold">#{{ $objetivo->objetivoEstrategico->idobjEstrategico ?? 'N/A' }}</p>
                                </div>

                                <div>
                                    <label class="text-xs font-medium text-gray-600">Descripción</label>
                                    <p class="text-gray-900 font-medium">{{ $objetivo->objetivoEstrategico->descripcion ?? 'N/A' }}</p>
                                </div>

                                <div>
                                    <label class="text-xs font-medium text-gray-600">Estado</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ ($objetivo->objetivoEstrategico->estado ?? '') == 'Activo' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $objetivo->objetivoEstrategico->estado ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Justificación --}}
                    @if($objetivo->justificacion)
                        <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 shadow-sm border border-purple-200">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Justificación de la Alineación</h3>
                                    <p class="text-gray-700 leading-relaxed">{{ $objetivo->justificacion }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Metadata --}}
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                            <div>
                                <span class="font-medium">Fecha de creación:</span>
                                <span class="ml-2">{{ $objetivo->created_at ? $objetivo->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="font-medium">Última actualización:</span>
                                <span class="ml-2">{{ $objetivo->updated_at ? $objetivo->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
