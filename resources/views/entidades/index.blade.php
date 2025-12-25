<x-app-layout>
    @section('title', 'Entidades')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Entidades') }}
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
                                ['label' => 'ID', 'type' => 'text'],
                                ['label' => 'Código', 'type' => 'text'],
                                ['label' => 'Subsector', 'type' => 'text'],
                                ['label' => 'Nivel de Gobierno', 'type' => 'text'],
                                ['label' => 'Estado', 'type' => 'badge'],
                                ['label' => 'Fecha de Creación', 'type' => 'date'],
                                ['label' => 'Fecha de Actualización', 'type' => 'date'],
                                ['label' => 'Acciones', 'type' => 'actions']
                            ]"
                            :csv="auth()->user()->canany(['generate report entidades', 'generate reports'])"
                            :print="auth()->user()->canany(['generate report entidades', 'generate reports'])"
                            :json="auth()->user()->canany(['generate report entidades', 'generate reports'])"
                            :excel="auth()->user()->canany(['generate report entidades', 'generate reports'])"
                            id="entidades-table"
                        >
                            <x-slot name="buttons">
                                @canany(['manage entidades', 'create entidades'])
                                    <button onclick="openCreateModal()"
                                            class="inline-flex items-center px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent active:bg-secondary focus:outline-none focus:border-secondary focus:ring ring-secondary/20 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Nueva Entidad
                                    </button>
                                @endcanany
                                @canany(['generate report entidades', 'generate reports'])
                                    <a href="{{ route('entidades.documentopdf') }}" target="_blank"
                                       class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-600 focus:outline-none focus:border-red-600 focus:ring ring-red-600/20 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Generar PDF
                                    </a>
                                @endcanany
                            </x-slot>

                            <tbody>
                                @foreach ($entidades as $entidad)
                                    <tr class="hover:bg-light/50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">{{ $entidad->idEntidad }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral">
                                            <span class="font-mono text-sm bg-light px-2 py-1 rounded">{{ $entidad->codigo }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral font-medium">{{ $entidad->subSector }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral">{{ $entidad->nivelGobierno }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full transition-colors duration-150
                                                @if ($entidad->estado == 'Activo') bg-accent/20 text-primary
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ $entidad->estado }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/70">
                                            {{ $entidad->fechaCreacion ? \Carbon\Carbon::parse($entidad->fechaCreacion)->format('d/m/Y') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/70">
                                            {{ $entidad->fechaActualizacion ? \Carbon\Carbon::parse($entidad->fechaActualizacion)->format('d/m/Y') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                @canany(['view entidades', 'manage entidades'])
                                                    <a href="{{ route('entidades.show', $entidad->idEntidad) }}"
                                                       class="text-secondary hover:text-accent font-medium transition-colors duration-150">
                                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                        Ver
                                                    </a>
                                                @endcanany
                                                @canany(['edit entidades', 'manage entidades'])
                                                    <button onclick="openEditModal({{ json_encode($entidad) }})"
                                                            class="text-neutral hover:text-primary font-medium transition-colors duration-150">
                                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                        Editar
                                                    </button>
                                                @endcanany
                                                @canany(['delete entidades', 'manage entidades'])
                                                    <button onclick="openDeleteModal({{ json_encode($entidad) }})"
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

    {{-- Incluir modales --}}
    @canany(['manage entidades', 'create entidades', 'edit entidades', 'delete entidades'])
        @canany(['create entidades', 'manage entidades'])
            @include('entidades.partials.create-modal')
        @endcanany
        @canany(['edit entidades', 'manage entidades'])
            @include('entidades.partials.edit-modal')
        @endcanany
        @canany(['delete entidades', 'manage entidades'])
            @include('entidades.partials.delete-modal')
        @endcanany
    @endcanany

    @canany(['manage entidades', 'create entidades', 'edit entidades', 'delete entidades'])
        @include('entidades.partials.edit-modal')
        @include('entidades.partials.delete-modal')
    @endcan

    @canany(['manage entidades', 'create entidades', 'edit entidades', 'delete entidades'])
        <script>
            function openCreateModal() {
                document.getElementById('createModal').classList.remove('hidden');
            }

            function closeCreateModal() {
                document.getElementById('createModal').classList.add('hidden');
            }

            function openEditModal(entidad) {
                document.getElementById('editForm').action = `/entidades/${entidad.idEntidad}`;
                document.getElementById('edit_codigo').value = entidad.codigo;
                document.getElementById('edit_subSector').value = entidad.subSector;
                document.getElementById('edit_nivelGobierno').value = entidad.nivelGobierno;
                document.getElementById('edit_estado').value = entidad.estado;
                document.getElementById('edit_fechaCreacion').value = entidad.fechaCreacion;
                document.getElementById('editModal').classList.remove('hidden');
            }

            function closeEditModal() {
                document.getElementById('editModal').classList.add('hidden');
            }

            function openDeleteModal(entidad) {
                document.getElementById('deleteForm').action = `/entidades/${entidad.idEntidad}`;
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
            }

            // Ejecutar cuando el DOM esté listo
            document.addEventListener('DOMContentLoaded', function() {
                // Cerrar modal al hacer clic fuera de él
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
