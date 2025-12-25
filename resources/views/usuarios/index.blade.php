<x-app-layout>
    @section('title', 'Usuarios')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    {{-- Validación mensaje --}}
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
                            ['label' => 'Nombre', 'type' => 'text'],
                            ['label' => 'Email', 'type' => 'text'],
                            ['label' => 'Roles', 'type' => 'text'],
                            ['label' => 'Fecha de Registro', 'type' => 'date'],
                            ['label' => 'Acciones', 'type' => 'actions'],
                        ]" :csv="false" :print="false" id="usuarios-table">
                            <x-slot name="buttons">
                                @canany(['manage usuarios', 'create usuarios'])
                                    <button onclick="openCreateModal()"
                                        class="inline-flex items-center px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent active:bg-secondary focus:outline-none focus:border-secondary focus:ring ring-secondary/20 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Nuevo Usuario
                                    </button>
                                @endcanany
                            </x-slot>

                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr class="hover:bg-light/50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">
                                            {{ $usuario->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral font-medium">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div
                                                        class="h-8 w-8 rounded-full bg-secondary flex items-center justify-center">
                                                        <span
                                                            class="text-white font-semibold text-sm">{{ strtoupper(substr($usuario->name, 0, 1)) }}</span>
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <span class="text-neutral font-medium">{{ $usuario->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral">
                                            <span class="font-mono text-sm">{{ $usuario->email }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral">
                                            @if ($usuario->roles->count() > 0)
                                                @foreach ($usuario->roles as $role)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mr-1">
                                                        {{ $role->name }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="text-gray-500 text-xs">Sin roles asignados</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/70">
                                            {{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                @canany(['view usuarios', 'manage usuarios'])
                                                    <a href="{{ route('usuarios.show', $usuario->id) }}"
                                                        class="text-secondary hover:text-accent font-medium transition-colors duration-150">
                                                        <svg class="w-4 h-4 inline mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        Ver
                                                    </a>
                                                @endcanany
                                                @canany(['edit usuarios', 'delete usuarios', 'manage usuarios'])
                                                    @canany(['edit usuarios', 'manage usuarios'])
                                                        <button onclick="openEditModal({{ json_encode($usuario) }})"
                                                            class="text-neutral hover:text-primary font-medium transition-colors duration-150">
                                                            <svg class="w-4 h-4 inline mr-1" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                            Editar
                                                        </button>
                                                    @endcanany
                                                    @canany(['delete usuarios', 'manage usuarios'])
                                                        <button
                                                            onclick="openDeleteModal('{{ route('usuarios.destroy', $usuario->id) }}')"
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

        @canany(['delete usuarios', 'manage usuarios'])
            {{-- Modal de confirmación de eliminación --}}
            <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3 text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mt-2">Confirmar eliminación</h3>
                        <div class="mt-2 px-7 py-3">
                            <p class="text-sm text-gray-500">
                                ¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.
                            </p>
                        </div>
                        <div class="flex justify-center space-x-4 px-4 py-3">
                            <button onclick="closeDeleteModal()"
                                class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                                Cancelar
                            </button>
                            <form id="deleteForm" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endcanany

        {{-- Modal de creación --}}
        @canany(['create usuarios', 'manage usuarios'])
            @include('usuarios.partials.create-modal')
        @endcanany

        {{-- Modal de edición --}}
        @canany(['edit usuarios', 'manage usuarios'])
            @include('usuarios.partials.edit-modal')
        @endcanany

    @canany(['manage usuarios', 'create usuarios', 'edit usuarios', 'delete usuarios'])
        <script>
            function openDeleteModal(action) {
                document.getElementById('deleteForm').action = action;
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
            }

            // Cerrar modal al hacer clic fuera de él
            document.getElementById('deleteModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeDeleteModal();
                }
            });
        </script>
    @endcanany
</x-app-layout>
