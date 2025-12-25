<x-app-layout>
    @section('title', 'Roles')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Roles') }}
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
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg shadow-sm">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif

                    <div class="bg-white">
                        <x-table
                            :headers="[
                                ['label' => 'ID', 'type' => 'text'],
                                ['label' => 'Nombre', 'type' => 'text'],
                                ['label' => 'Permisos', 'type' => 'text'],
                                ['label' => 'Usuarios Asignados', 'type' => 'text'],
                                ['label' => 'Fecha de Creación', 'type' => 'date'],
                                ['label' => 'Acciones', 'type' => 'actions']
                            ]"
                            :csv="false"
                            :print="false"
                            id="roles-table"
                        >
                            <x-slot name="buttons">
                                @canany(['manage roles', 'create roles'])
                                    <button onclick="openCreateModal()"
                                            class="inline-flex items-center px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent active:bg-secondary focus:outline-none focus:border-secondary focus:ring ring-secondary/20 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                        </svg>
                                        Nuevo Rol
                                    </button>
                                @endcanany
                            </x-slot>

                            <tbody>
                                @foreach ($roles as $role)
                                    <tr class="hover:bg-light/50 transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-primary">{{ $role->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral font-medium">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div class="h-8 w-8 rounded-full bg-purple-500 flex items-center justify-center">
                                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="ml-3">
                                                    <span class="text-neutral font-medium">{{ $role->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-neutral">
                                            @if($role->permissions->count() > 0)
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($role->permissions->take(3) as $permission)
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                            {{ $permission->name }}
                                                        </span>
                                                    @endforeach
                                                    @if($role->permissions->count() > 3)
                                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600">
                                                            +{{ $role->permissions->count() - 3 }} más
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-gray-500 text-xs">Sin permisos asignados</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $role->users->count() }} usuarios
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-neutral/70">
                                            {{ $role->created_at ? $role->created_at->format('d/m/Y H:i') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                @canany(['view roles', 'manage roles'])
                                                    <a href="{{ route('roles.show', $role->id) }}"
                                                       class="text-secondary hover:text-accent font-medium transition-colors duration-150">
                                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                        Ver
                                                    </a>
                                                @endcanany
                                                @canany(['edit roles', 'delete roles', 'manage roles'])
                                                    @canany(['edit roles', 'manage roles'])
                                                        <button onclick="openEditModal({{ json_encode($role) }})"
                                                                class="text-neutral hover:text-primary font-medium transition-colors duration-150">
                                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                            </svg>
                                                            Editar
                                                        </button>
                                                    @endcanany
                                                    @canany(['delete roles', 'manage roles'])
                                                        <button onclick="openDeleteModal('{{ route('roles.destroy', $role->id) }}')"
                                                                class="text-red-600 hover:text-red-900 font-medium transition-colors duration-150">
                                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
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
    @canany(['manage roles', 'create roles'])
        @include('roles.partials.create-modal')
    @endcanany
    @canany(['manage roles', 'edit roles'])
        @include('roles.partials.edit-modal')
    @endcanany
    @canany(['manage roles', 'delete roles'])
        @include('roles.partials.delete-modal')
    @endcanany

    @canany(['manage roles', 'create roles', 'edit roles', 'delete roles'])
        <script>
            function openCreateModal() {
                // Cargar permisos para el modal de crear
                fetch('/roles/create', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Limpiar checkboxes anteriores
                    const checkboxContainer = document.getElementById('create-permissions-container');
                    checkboxContainer.innerHTML = '';

                    // Añadir checkboxes para cada permiso
                    data.permissions.forEach(permission => {
                        const div = document.createElement('div');
                        div.className = 'flex items-center';
                        div.innerHTML = `
                            <input type="checkbox"
                                id="create_permission_${permission.id}"
                                name="permissions[]"
                                value="${permission.id}"
                                class="rounded border-gray-300 text-primary focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <label for="create_permission_${permission.id}" class="ml-2 text-sm text-gray-700">
                                ${permission.name}
                            </label>
                        `;
                        checkboxContainer.appendChild(div);
                    });

                    document.getElementById('createModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al cargar los permisos');
                });
            }

            function closeCreateModal() {
                document.getElementById('createModal').classList.add('hidden');
            }

            function openEditModal(role) {
                // Cargar datos del rol y permisos
                fetch(`/roles/${role.id}/edit`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Establecer el nombre del rol
                    document.getElementById('edit_name').value = data.role.name;
                    document.getElementById('editForm').action = `/roles/${role.id}`;

                    // Limpiar checkboxes anteriores
                    const checkboxContainer = document.getElementById('edit-permissions-container');
                    checkboxContainer.innerHTML = '';

                    // Obtener IDs de permisos del rol
                    const rolePermissionIds = data.role.permissions.map(p => p.id);

                    // Añadir checkboxes para cada permiso
                    data.permissions.forEach(permission => {
                        const isChecked = rolePermissionIds.includes(permission.id);
                        const div = document.createElement('div');
                        div.className = 'flex items-center';
                        div.innerHTML = `
                            <input type="checkbox"
                                id="edit_permission_${permission.id}"
                                name="permissions[]"
                                value="${permission.id}"
                                ${isChecked ? 'checked' : ''}
                                class="rounded border-gray-300 text-primary focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <label for="edit_permission_${permission.id}" class="ml-2 text-sm text-gray-700">
                                ${permission.name}
                            </label>
                        `;
                        checkboxContainer.appendChild(div);
                    });

                    document.getElementById('editModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al cargar los datos del rol');
                });
            }

            function closeEditModal() {
                document.getElementById('editModal').classList.add('hidden');
            }

            function openDeleteModal(action) {
                console.log('Opening delete modal with action:', action);
                const form = document.getElementById('deleteForm');
                const modal = document.getElementById('deleteModal');

                if (form && modal) {
                    form.action = action;
                    modal.classList.remove('hidden');
                    console.log('Delete modal opened successfully');
                } else {
                    console.error('Delete form or modal not found', { form, modal });
                }
            }

            function closeDeleteModal() {
                const modal = document.getElementById('deleteModal');
                if (modal) {
                    modal.classList.add('hidden');
                    console.log('Delete modal closed successfully');
                } else {
                    console.error('Delete modal not found');
                }
            }

            // Ejecutar cuando el DOM esté listo
            document.addEventListener('DOMContentLoaded', function() {
                // Cerrar modal al hacer clic fuera de él
                const deleteModal = document.getElementById('deleteModal');
                if (deleteModal) {
                    deleteModal.addEventListener('click', function(e) {
                        if (e.target === this) {
                            closeDeleteModal();
                        }
                    });
                }

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
            });
        </script>
    @endcanany
</x-app-layout>
