<x-app-layout>
    @section('title', 'ODS')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Objetivos ODS') }}
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
                                ['label' => '# ODS', 'type' => 'text'],
                                ['label' => 'Nombre ODS', 'type' => 'text'],
                                ['label' => 'Descripción', 'type' => 'text'],
                                ['label' => 'Acciones', 'type' => 'actions']
                            ]"
                            :csv="auth()->user()->canany(['generate report ods', 'generate reports'])"
                            :print="auth()->user()->canany(['generate report ods', 'generate reports'])"
                            :json="auth()->user()->canany(['generate report ods', 'generate reports'])"
                            :excel="auth()->user()->canany(['generate report ods', 'generate reports'])"
                            id="ods-table"
                            title="Gestión de Objetivos de Desarrollo Sostenible"
                        >
                            <x-slot name="buttons">
                                @canany(['manage ods', 'create ods'])
                                    <button onclick="openCreateModal()"
                                       class="inline-flex items-center px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent active:bg-secondary focus:outline-none focus:border-secondary focus:ring ring-secondary/20 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Nuevo Objetivo ODS
                                    </button>
                                @endcanany
                                @canany(['generate report ods', 'generate reports'])
                                    <a href="{{ route('ods.documentopdf') }}" target="_blank"
                                       class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-600 focus:outline-none focus:border-red-600 focus:ring ring-red-600/20 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Generar PDF
                                    </a>
                                @endcanany
                            </x-slot>

                            <tbody>
                                @foreach ($ods as $ods)
                                    <tr class="hover:bg-light/50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">{{ $ods->idOds }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-secondary font-bold">ODS {{ $ods->odsnum }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral font-medium">{{ $ods->nombre }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/70">{{ Str::limit($ods->descripcion, 50) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                @canany(['view ods', 'manage ods'])
                                                    <a href="{{ route('ods.show', $ods->idOds) }}"
                                                       class="text-blue-600 hover:text-blue-900 font-medium transition-colors duration-150">
                                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                        Ver
                                                    </a>
                                                @endcanany
                                                @canany(['edit ods', 'manage ods'])
                                                    <button onclick="openEditModal({{ $ods->idOds }}, '{{ $ods->odsnum }}', {{ json_encode($ods->nombre) }}, {{ json_encode($ods->descripcion) }})"
                                                            class="text-neutral hover:text-primary font-medium transition-colors duration-150">
                                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>
                                                        Editar
                                                    </button>
                                                @endcanany
                                                @canany(['delete ods', 'manage ods'])
                                                    <button onclick="openDeleteModal({{ $ods->idOds }}, {{ json_encode($ods->nombre) }})"
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
    @canany(['manage ods', 'create ods', 'edit ods', 'delete ods'])
        @canany(['create ods', 'manage ods'])
            @include('ods.partials.create-modal')
        @endcanany
        @canany(['edit ods', 'manage ods'])
            @include('ods.partials.edit-modal')
        @endcanany
        @canany(['delete ods', 'manage ods'])
            @include('ods.partials.delete-modal')
        @endcanany
    @endcanany

    @canany(['manage ods', 'create ods', 'edit ods', 'delete ods'])
        <script>
            function openCreateModal() {
                document.getElementById('createModal').style.display = 'block';
            }

            function closeCreateModal() {
                document.getElementById('createModal').style.display = 'none';
            }

            function openEditModal(id, odsnum, nombre, descripcion) {
                document.getElementById('editForm').action = `/ods/${id}`;
                document.getElementById('edit_odsnum').value = odsnum;
                document.getElementById('edit_nombre').value = nombre;
                document.getElementById('edit_descripcion').value = descripcion;
                document.getElementById('editModal').style.display = 'block';
            }

            function closeEditModal() {
                document.getElementById('editModal').style.display = 'none';
            }

            function openDeleteModal(id, nombre) {
                document.getElementById('deleteForm').action = `/ods/${id}`;
                document.getElementById('deleteModal').style.display = 'block';
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').style.display = 'none';
            }
        </script>
    @endcanany
</x-app-layout>
