<x-app-layout>
    @section('title', 'Detalle de la Unidad')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Detalle de la Unidad Organizacional') }}
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
                                <h1 class="text-3xl font-bold text-primary">{{ $unidad->macrosector }}</h1>
                                <p class="text-neutral/70 mt-1">Unidad ID: {{ $unidad->idUnidad }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 md:mt-0 flex space-x-3">
                            <a href="{{ route('unidades.index') }}" 
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
                            @if ($unidad->estado == 'Activo') bg-accent/20 text-primary
                            @else bg-red-100 text-red-800 @endif">
                            {{ $unidad->estado }}
                        </span>
                    </div>

                    {{-- Información de la unidad --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Información organizacional --}}
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 shadow-sm border border-blue-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Información Organizacional</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">ID de Unidad</label>
                                    <p class="text-gray-900 font-semibold text-lg">{{ $unidad->idUnidad }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Macrosector</label>
                                    <p class="text-gray-900 font-semibold">{{ $unidad->macrosector }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Sector Específico</label>
                                    <p class="text-gray-900">{{ $unidad->sector }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Información de estado --}}
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 shadow-sm border border-green-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Estado de la Unidad</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Estado Actual</label>
                                    <div class="mt-2">
                                        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                                            @if ($unidad->estado == 'Activo') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ $unidad->estado }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Descripción del Estado</label>
                                    <p class="text-gray-700 mt-1">
                                        @if ($unidad->estado == 'Activo')
                                            Esta unidad organizacional está operativa y funcionando normalmente.
                                        @else
                                            Esta unidad organizacional no está activa en el sistema.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Información adicional --}}
                    <div class="mt-8">
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 shadow-sm border border-purple-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Descripción Detallada</h3>
                            </div>
                            
                            <div>
                                <p class="text-gray-700 leading-relaxed">
                                    La unidad organizacional <strong>{{ $unidad->macrosector }}</strong> pertenece al sector específico de 
                                    <strong>{{ $unidad->sector }}</strong>. Esta unidad es parte de la estructura organizacional 
                                    del sistema y se encuentra actualmente en estado <strong>{{ $unidad->estado }}</strong>.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
