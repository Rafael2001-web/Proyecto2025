<x-app-layout>
    @section('title', 'Detalle del Objetivo PND')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Plan Nacional de Desarrollo - Detalle del Objetivo') }}
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
                                <div class="w-16 h-16 bg-gradient-to-r from-red-500 to-yellow-500 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-primary">Objetivo Nacional {{ $pnd->objetivoN }}</h1>
                                <p class="text-neutral/70 mt-1">{{ $pnd->eje }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-4 md:mt-0 flex space-x-3">
                            <a href="{{ route('pnd.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Volver al listado
                            </a>
                        </div>
                    </div>

                    {{-- Información del objetivo PND --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        
                        {{-- Información básica --}}
                        <div class="bg-gradient-to-br from-red-50 to-red-100 rounded-xl p-6 shadow-sm border border-red-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Información del Objetivo</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">ID del Objetivo</label>
                                    <p class="text-gray-900 font-semibold text-lg">{{ $pnd->idPnd }}</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Número de Objetivo Nacional</label>
                                    <div class="flex items-center mt-1">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            Objetivo {{ $pnd->objetivoN }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Eje Estratégico</label>
                                    <p class="text-gray-900 font-semibold text-base mt-1">{{ $pnd->eje }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Contexto del Plan Nacional --}}
                        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl p-6 shadow-sm border border-yellow-200">
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800">Plan Nacional de Desarrollo</h3>
                            </div>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Alcance</label>
                                    <p class="text-gray-900">Nacional - República de Colombia</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Nivel de Impacto</label>
                                    <p class="text-gray-700">Estratégico Nacional - Marco de política pública</p>
                                </div>
                                
                                <div>
                                    <label class="text-sm font-medium text-gray-600">Tipo de Objetivo</label>
                                    <p class="text-gray-700">Objetivo Nacional del Plan de Desarrollo</p>
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
                            <h3 class="text-lg font-semibold text-gray-800">Descripción del Objetivo Nacional</h3>
                        </div>
                        
                        <div class="prose max-w-none">
                            <p class="text-gray-700 leading-relaxed text-justify">
                                {{ $pnd->descripcion }}
                            </p>
                        </div>
                    </div>

                    {{-- Información contextual sobre el PND --}}
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 shadow-sm border border-blue-200">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800">Sobre el Plan Nacional de Desarrollo</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center mb-4">
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold text-red-600">🇨🇴</div>
                                <div class="text-sm text-gray-600">Colombia</div>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold text-yellow-600">4</div>
                                <div class="text-sm text-gray-600">Años de vigencia</div>
                            </div>
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="text-2xl font-bold text-green-600">📊</div>
                                <div class="text-sm text-gray-600">Marco estratégico</div>
                            </div>
                        </div>
                        
                        <p class="text-gray-700 text-sm text-center">
                            El Plan Nacional de Desarrollo es el documento que establece los objetivos y metas del Gobierno Nacional 
                            para un período presidencial de cuatro años. Define las estrategias y orientaciones de política pública 
                            para promover el desarrollo económico, social e institucional del país.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
