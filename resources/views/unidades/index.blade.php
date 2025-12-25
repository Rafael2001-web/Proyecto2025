<x-app-layout>
    @section('title', 'Unidades')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Unidades') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-neutral/20">
                    {{-- Validacion mensaje --}}
                    @if (session('success'))
                        <div class="mb-6 p-4 bg-accent/20 border border-accent/40 text-primary rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    <div class="bg-white">
                        <x-table :headers="[
                            ['label' => 'ID', 'type' => 'text'],
                            ['label' => 'Macrosector', 'type' => 'text'],
                            ['label' => 'Sector', 'type' => 'text'],
                            ['label' => 'Estado', 'type' => 'badge'],
                            ['label' => 'Acciones', 'type' => 'actions'],
                        ]" :csv="auth()->user()->canany(['generate report unidades', 'generate reports'])"
                            :print="auth()->user()->canany(['generate report unidades', 'generate reports'])"
                            :json="auth()->user()->canany(['generate report unidades', 'generate reports'])"
                            :excel="auth()->user()->canany(['generate report unidades', 'generate reports'])"
                            id="unidades-table"
                            title="Gestión de Unidades">
                            <x-slot name="buttons">
                                @canany(['manage unidades', 'create unidades'])
                                    <button onclick="openCreateModal()"
                                            class="inline-flex items-center px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent active:bg-secondary focus:outline-none focus:border-secondary focus:ring ring-secondary/20 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Nueva Unidad
                                    </button>
                                @endcanany
                                @canany(['generate report unidades', 'generate reports'])
                                    <a href="{{ route('unidades.documentopdf') }}" target="_blank"
                                       class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-600 focus:outline-none focus:border-red-600 focus:ring ring-red-600/20 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Generar PDF
                                    </a>
                                @endcanany
                            </x-slot>

                            <tbody>
                                @foreach ($unidades as $unidad)
                                    <tr class="hover:bg-light/50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">
                                            {{ $unidad->idUnidad }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral">
                                            {{ $unidad->macrosector }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral">
                                            {{ $unidad->sector }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $unidad->estado == 'Activo' ? 'bg-accent/20 text-primary' : 'bg-red-100 text-red-800' }}">
                                                {{ $unidad->estado == 'Activo' ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                @canany(['view unidades', 'manage unidades'])
                                                    <a href="{{ route('unidades.show', $unidad->idUnidad) }}"
                                                        class="text-secondary hover:text-accent font-medium transition-colors duration-150">
                                                        <svg class="w-4 h-4 inline mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        Ver
                                                    </a>
                                                @endcanany
                                                @canany(['edit unidades', 'delete unidades', 'manage unidades'])
                                                    @canany(['edit unidades', 'manage unidades'])
                                                        <button onclick="openEditModal({{ json_encode($unidad) }})"
                                                                class="text-neutral hover:text-primary font-medium transition-colors duration-150">
                                                            <svg class="w-4 h-4 inline mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                            Editar
                                                        </button>
                                                    @endcanany
                                                    @canany(['delete unidades', 'manage unidades'])
                                                        <button onclick="openDeleteModal({{ json_encode($unidad) }})"
                                                                class="text-red-600 hover:text-red-900 font-medium transition-colors duration-150">
                                                            <svg class="w-4 h-4 inline mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Eliminar
                                                        </button>
                                                    @endcanany
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
    @canany(['manage unidades', 'create unidades', 'edit unidades', 'delete unidades'])
        @canany(['create unidades', 'manage unidades'])
            @include('unidades.partials.create-modal')
        @endcanany
        @canany(['edit unidades', 'manage unidades'])
            @include('unidades.partials.edit-modal')
        @endcanany
        @canany(['delete unidades', 'manage unidades'])
            @include('unidades.partials.delete-modal')
        @endcanany
    @endcanany

    @canany(['manage unidades', 'create unidades', 'edit unidades', 'delete unidades'])
        <script>
            function openCreateModal() {
                document.getElementById('createModal').classList.remove('hidden');
            }

            function closeCreateModal() {
                document.getElementById('createModal').classList.add('hidden');
            }

            function openEditModal(unidad) {
                document.getElementById('editForm').action = `/unidades/${unidad.idUnidad}`;
                document.getElementById('edit_macrosector').value = unidad.macrosector;
                document.getElementById('edit_sector').value = unidad.sector;
                document.getElementById('edit_estado').value = unidad.estado;
                document.getElementById('editModal').classList.remove('hidden');
            }

            function closeEditModal() {
                document.getElementById('editModal').classList.add('hidden');
            }

            function openDeleteModal(unidad) {
                document.getElementById('deleteForm').action = `/unidades/${unidad.idUnidad}`;
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
