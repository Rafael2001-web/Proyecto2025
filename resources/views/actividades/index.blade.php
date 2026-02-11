<x-app-layout>
    @section('title', 'Actividades')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Actividades') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    {{-- Validacion mensaje --}}
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-accent/20 border border-accent/40 text-primary rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <div class="bg-white">
                        <x-table
                            :headers="[
                                ['label' => 'Proyecto', 'type' => 'text'],
                                ['label' => 'Código', 'type' => 'text'],
                                ['label' => 'Nombre', 'type' => 'text'],
                                ['label' => 'Activo/Inactivo', 'type' => 'badge'],
                                ['label' => 'Responsable', 'type' => 'text'],
                                ['label' => 'Estado Avance', 'type' => 'badge'],
                                ['label' => 'Prioridad', 'type' => 'badge'],
                                ['label' => 'Inicio Plan', 'type' => 'date'],
                                ['label' => 'Fin Plan', 'type' => 'date'],
                                ['label' => 'Avance Real', 'type' => 'decimal'],
                                ['label' => 'Indicador Avance', 'type' => 'decimal'],
                                ['label' => 'Variación Tiempo', 'type' => 'decimal'],
                                ['label' => 'Estado Reportado', 'type' => 'badge'],
                                ['label' => 'Acciones', 'type' => 'actions']
                            ]"
                            :csv="auth()->user()->canany(['generate report actividades', 'generate reports'])"
                            :print="auth()->user()->canany(['generate report actividades', 'generate reports'])"
                            :json="auth()->user()->canany(['generate report actividades', 'generate reports'])"
                            :excel="auth()->user()->canany(['generate report actividades', 'generate reports'])"
                            id="actividades-table"
                            title="Gestión de Actividades"
                        >
                            <x-slot name="buttons">
                                @canany(['manage actividades', 'create actividades'])
                                    <button onclick="openCreateModal()"
                                            class="inline-flex items-center px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent active:bg-secondary focus:outline-none focus:border-secondary focus:ring ring-secondary/20 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Nueva Actividad
                                    </button>
                                @endcanany
                                @canany(['generate report actividades', 'generate reports'])
                                    <a href="{{ route('actividades.documentopdf') }}" target="_blank"
                                       class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-600 focus:outline-none focus:border-red-600 focus:ring ring-red-600/20 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Generar PDF
                                    </a>
                                @endcanany
                            </x-slot>

                            <tbody>
                                @foreach ($actividades as $actividad)
                                    @php
                                        $avancePlan = $actividad->avance_planificado;
                                        $avanceReal = $actividad->avance_real;
                                        $indicadorAvance = null;
                                        if ($avancePlan !== null && $avancePlan > 0 && $avanceReal !== null) {
                                            $indicadorAvance = ($avanceReal / $avancePlan) * 100;
                                        }
                                    @endphp
                                    <tr class="hover:bg-light/50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral font-medium">
                                            {{ $actividad->proyecto->nombre ?? 'Sin proyecto' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral">
                                            <span class="font-mono text-sm bg-light px-2 py-1 rounded">{{ $actividad->codigo }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral font-medium">{{ $actividad->nombre }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full transition-colors duration-150
                                                @if ($actividad->estadoAct == 'Activo') bg-accent/20 text-primary
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ $actividad->estadoAct }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral">
                                            {{ $actividad->responsable ?: 'No asignado' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if ($actividad->estado === 'COMPLETADA') bg-secondary/20 text-primary
                                                @elseif ($actividad->estado === 'EN_PROGRESO') bg-amber-100 text-amber-800
                                                @else bg-neutral/20 text-neutral @endif">
                                                {{ $actividad->estado }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-light text-neutral">
                                                {{ $actividad->prioridad }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral">
                                            {{ optional($actividad->fecha_inicio_planificada)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral">
                                            {{ optional($actividad->fecha_fin_planificada)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral font-semibold">
                                            {{ $actividad->avance_real !== null ? number_format($actividad->avance_real, 2) . '%' : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral">
                                            {{ $indicadorAvance !== null ? number_format($indicadorAvance, 2) . '%' : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral">
                                            {{ $actividad->variacion_tiempo_dias !== null ? $actividad->variacion_tiempo_dias : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if ($actividad->estado_reportado === 'COMPLETADA') bg-secondary/20 text-primary
                                                @elseif ($actividad->estado_reportado === 'EN_RIESGO') bg-red-100 text-red-800
                                                @else bg-neutral/20 text-neutral @endif">
                                                {{ $actividad->estado_reportado }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                @canany(['view actividades', 'manage actividades'])
                                                    <a href="{{ route('actividades.show', $actividad->id) }}"
                                                       class="text-secondary hover:text-accent font-medium transition-colors duration-150">
                                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                        Ver
                                                    </a>
                                                @endcanany
                                                @canany(['edit actividades', 'manage actividades'])
                                                    <button onclick="openEditModal({
                                                        id: {{ $actividad->id }},
                                                        proyecto_id: {{ $actividad->proyecto_id ?? 'null' }},
                                                        codigo: {{ json_encode($actividad->codigo) }},
                                                        nombre: {{ json_encode($actividad->nombre) }},
                                                        estadoAct: {{ json_encode($actividad->estadoAct) }},
                                                        descripcion: {{ json_encode($actividad->descripcion) }},
                                                        responsable: {{ json_encode($actividad->responsable) }},
                                                        estado: {{ json_encode($actividad->estado) }},
                                                        prioridad: {{ $actividad->prioridad }},
                                                        fecha_inicio_planificada: '{{ optional($actividad->fecha_inicio_planificada)->format('Y-m-d') }}',
                                                        fecha_fin_planificada: '{{ optional($actividad->fecha_fin_planificada)->format('Y-m-d') }}',
                                                        fecha_inicio_real: '{{ optional($actividad->fecha_inicio_real)->format('Y-m-d') }}',
                                                        fecha_fin_real: '{{ optional($actividad->fecha_fin_real)->format('Y-m-d') }}',
                                                        avance_planificado: {{ $actividad->avance_planificado ?? 'null' }},
                                                        avance_real: {{ $actividad->avance_real ?? 'null' }},
                                                        objetivos: @json($actividad->objetivosEstrategicos->pluck('idobjEstrategico'))
                                                    })"
                                                            class="text-neutral hover:text-primary font-medium transition-colors duration-150">
                                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                        Editar
                                                    </button>
                                                @endcanany
                                                @canany(['delete actividades', 'manage actividades'])
                                                    <button onclick="openDeleteModal({
                                                        id: {{ $actividad->id }},
                                                        nombre: {{ json_encode($actividad->nombre) }}
                                                    })"
                                                            class="text-red-600 hover:text-red-900 font-medium transition-colors duration-150">
                                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Eliminar
                                                    </button>
                                                @endcanany
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </x-table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modales --}}
    @canany(['manage actividades', 'create actividades'])
        @include('actividades.partials.create-modal')
    @endcanany
    @canany(['manage actividades', 'edit actividades'])
        @include('actividades.partials.edit-modal')
    @endcanany
    @canany(['manage actividades', 'delete actividades'])
        @include('actividades.partials.delete-modal')
    @endcanany

    @canany(['manage actividades', 'create actividades', 'edit actividades', 'delete actividades'])
        <script>
            function openCreateModal() {
                document.getElementById('createForm').reset();
                document.getElementById('createModal').classList.remove('hidden');
            }

            function closeCreateModal() {
                document.getElementById('createModal').classList.add('hidden');
            }

            function openEditModal(actividad) {
                document.getElementById('editForm').action = `/actividades/${actividad.id}`;
                document.getElementById('edit_proyecto_id').value = actividad.proyecto_id ?? '';
                document.getElementById('edit_codigo').value = actividad.codigo ?? '';
                document.getElementById('edit_nombre').value = actividad.nombre ?? '';
                document.getElementById('edit_descripcion').value = actividad.descripcion ?? '';
                document.getElementById('edit_responsable').value = actividad.responsable ?? '';
                document.getElementById('edit_estado').value = actividad.estado ?? 'PLANIFICADA';
                document.getElementById('edit_prioridad').value = actividad.prioridad ?? 1;
                document.getElementById('edit_fecha_inicio_planificada').value = actividad.fecha_inicio_planificada ?? '';
                document.getElementById('edit_fecha_fin_planificada').value = actividad.fecha_fin_planificada ?? '';
                document.getElementById('edit_fecha_inicio_real').value = actividad.fecha_inicio_real ?? '';
                document.getElementById('edit_fecha_fin_real').value = actividad.fecha_fin_real ?? '';
                document.getElementById('edit_avance_planificado').value = actividad.avance_planificado ?? '';
                document.getElementById('edit_avance_real').value = actividad.avance_real ?? '';

                const objetivosSelect = document.getElementById('edit_objetivos_estrategicos');
                if (objetivosSelect) {
                    const selected = Array.isArray(actividad.objetivos)
                        ? actividad.objetivos.map(Number)
                        : [];
                    Array.from(objetivosSelect.options).forEach(option => {
                        option.selected = selected.includes(parseInt(option.value, 10));
                    });
                }

                document.getElementById('editModal').classList.remove('hidden');
            }

            function closeEditModal() {
                document.getElementById('editModal').classList.add('hidden');
            }

            function openDeleteModal(actividad) {
                document.getElementById('deleteForm').action = `/actividades/${actividad.id}`;
                document.getElementById('delete-actividad-name').textContent = actividad.nombre ?? '';
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
            }

            document.addEventListener('DOMContentLoaded', function() {
                const createModal = document.getElementById('createModal');
                if (createModal) {
                    createModal.addEventListener('click', function(e) {
                        if (e.target === this) {
                            closeCreateModal();
                        }
                    });
                }

                const editModal = document.getElementById('editModal');
                if (editModal) {
                    editModal.addEventListener('click', function(e) {
                        if (e.target === this) {
                            closeEditModal();
                        }
                    });
                }

                const deleteModal = document.getElementById('deleteModal');
                if (deleteModal) {
                    deleteModal.addEventListener('click', function(e) {
                        if (e.target === this) {
                            closeDeleteModal();
                        }
                    });
                }
            });
        </script>
    @endcanany
</x-app-layout>