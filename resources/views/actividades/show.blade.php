<x-app-layout>
	@section('title', 'Detalle de la Actividad')

	<x-slot name="header">
		<h2 class="font-semibold text-xl text-white leading-tight">
			{{ __('Detalle de la Actividad') }}
		</h2>
	</x-slot>

	<div class="py-5">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
				<div class="p-6 lg:p-8 bg-white">
					<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
						<div class="flex items-center space-x-4">
							<div class="flex-shrink-0">
								<div class="w-16 h-16 bg-gradient-to-r from-secondary to-accent rounded-full flex items-center justify-center shadow-lg">
									<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V9a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
									</svg>
								</div>
							</div>
							<div>
								<h1 class="text-3xl font-bold text-primary">{{ $actividad->nombre }}</h1>
								<p class="text-neutral/70 mt-1">Código: {{ $actividad->codigo }}</p>
							</div>
						</div>

						<div class="mt-4 md:mt-0 flex space-x-3">
							<a href="{{ route('actividades.index') }}"
							   class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition ease-in-out duration-150">
								<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
								</svg>
								Volver al listado
							</a>
						</div>
					</div>

					<div class="mb-6 flex flex-wrap gap-2">
						<span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full
							@if ($actividad->estado === 'COMPLETADA') bg-secondary/20 text-primary
							@elseif ($actividad->estado === 'EN_PROGRESO') bg-amber-100 text-amber-800
							@else bg-neutral/20 text-neutral @endif">
							{{ $actividad->estado }}
						</span>
						<span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full
							@if ($actividad->estado_reportado === 'COMPLETADA') bg-secondary/20 text-primary
							@elseif ($actividad->estado_reportado === 'EN_RIESGO') bg-red-100 text-red-800
							@else bg-neutral/20 text-neutral @endif">
							{{ $actividad->estado_reportado }}
						</span>
						<span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full bg-light text-neutral">
							Prioridad {{ $actividad->prioridad }}
						</span>
						<span class="px-4 py-2 inline-flex text-sm leading-5 font-semibold rounded-full {{ $actividad->activo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
							{{ $actividad->activo ? 'Activa' : 'Inactiva' }}
						</span>
					</div>

					<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
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
									<label class="text-sm font-medium text-gray-600">Proyecto</label>
									<p class="text-gray-900 font-semibold">{{ $actividad->proyecto->nombre ?? 'Sin proyecto' }}</p>
								</div>
								<div>
									<label class="text-sm font-medium text-gray-600">Responsable</label>
									<p class="text-gray-900">{{ $actividad->responsable ?: 'No asignado' }}</p>
								</div>
								<div>
									<label class="text-sm font-medium text-gray-600">Descripción</label>
									<p class="text-gray-700">{{ $actividad->descripcion ?: 'No disponible' }}</p>
								</div>
							</div>
						</div>

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
									<label class="text-sm font-medium text-gray-600">Inicio Planificado</label>
									<p class="text-gray-900 font-semibold">{{ optional($actividad->fecha_inicio_planificada)->format('d/m/Y') }}</p>
								</div>
								<div>
									<label class="text-sm font-medium text-gray-600">Fin Planificado</label>
									<p class="text-gray-900 font-semibold">{{ optional($actividad->fecha_fin_planificada)->format('d/m/Y') }}</p>
								</div>
								<div>
									<label class="text-sm font-medium text-gray-600">Inicio Real</label>
									<p class="text-gray-900">{{ optional($actividad->fecha_inicio_real)->format('d/m/Y') ?: 'No definido' }}</p>
								</div>
								<div>
									<label class="text-sm font-medium text-gray-600">Fin Real</label>
									<p class="text-gray-900">{{ optional($actividad->fecha_fin_real)->format('d/m/Y') ?: 'No definido' }}</p>
								</div>
							</div>
						</div>
					</div>

					<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
						<div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 shadow-sm border border-green-200">
							<div class="flex items-center mb-4">
								<div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
									<svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
									</svg>
								</div>
								<h3 class="text-lg font-semibold text-gray-800">Avance</h3>
							</div>

							<div class="space-y-3">
								<div>
									<label class="text-sm font-medium text-gray-600">Avance Planificado</label>
									<p class="text-2xl font-bold text-green-700">
										{{ $actividad->avance_planificado !== null ? number_format($actividad->avance_planificado, 2) . '%' : 'N/A' }}
									</p>
								</div>
								<div>
									<label class="text-sm font-medium text-gray-600">Avance Real</label>
									<p class="text-2xl font-bold text-green-700">
										{{ $actividad->avance_real !== null ? number_format($actividad->avance_real, 2) . '%' : 'N/A' }}
									</p>
								</div>
								<div>
									<label class="text-sm font-medium text-gray-600">Variación de Tiempo (días)</label>
									<p class="text-gray-900">{{ $actividad->variacion_tiempo_dias ?? 'N/A' }}</p>
								</div>
							</div>
						</div>

						<div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl p-6 shadow-sm border border-indigo-200">
							<div class="flex items-center mb-4">
								<div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
									<svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
									</svg>
								</div>
								<h3 class="text-lg font-semibold text-gray-800">Objetivos Estratégicos</h3>
							</div>

							<div class="space-y-2">
								@forelse($actividad->objetivosEstrategicos as $objetivo)
									<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-secondary/20 text-primary">
										{{ $objetivo->descripcion }}
									</span>
								@empty
									<p class="text-gray-700">No hay objetivos asociados.</p>
								@endforelse
							</div>
						</div>
					</div>

					@php
						$avancePlan = $actividad->avance_planificado;
						$avanceReal = $actividad->avance_real;
						$indicadorAvance = null;
						if ($avancePlan !== null && $avancePlan > 0 && $avanceReal !== null) {
							$indicadorAvance = ($avanceReal / $avancePlan) * 100;
						}
					@endphp

					<div class="mt-8">
						<h3 class="text-lg font-semibold text-gray-800 mb-4">Indicadores de Actividad</h3>
						<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
							<div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
								<p class="text-xs text-gray-500">Indicador de Avance</p>
								<p class="text-2xl font-bold text-primary mt-1">
									{{ $indicadorAvance !== null ? number_format($indicadorAvance, 2) . '%' : 'N/A' }}
								</p>
								<p class="text-xs text-gray-500 mt-2">avance_real / avance_planificado * 100</p>
							</div>
							<div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
								<p class="text-xs text-gray-500">Indicador de Tiempo</p>
								<p class="text-2xl font-bold text-primary mt-1">
									{{ $actividad->variacion_tiempo_dias !== null ? $actividad->variacion_tiempo_dias . ' días' : 'N/A' }}
								</p>
								<p class="text-xs text-gray-500 mt-2">fecha_real_fin - fecha_planificada_fin</p>
							</div>
							<div class="bg-white rounded-xl p-5 shadow-sm border border-gray-200">
								<p class="text-xs text-gray-500">Cumplimiento de Plazo</p>
								<p class="text-2xl font-bold text-primary mt-1">{{ $actividad->estado_reportado }}</p>
								<p class="text-xs text-gray-500 mt-2">Completada / En Riesgo / No Iniciada</p>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</x-app-layout>