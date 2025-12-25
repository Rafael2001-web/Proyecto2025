{{-- Modal de creación de usuario --}}
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Crear Nuevo Usuario</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="createForm" action="{{ route('usuarios.store') }}" method="POST">
                @csrf

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Nombre --}}
                        <div>
                            <label for="create_name" class="block text-sm font-medium text-gray-700 mb-1">
                                Nombre completo <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="create_name"
                                   name="name"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="create_email" class="block text-sm font-medium text-gray-700 mb-1">
                                Correo electrónico <span class="text-red-500">*</span>
                            </label>
                            <input type="email"
                                   id="create_email"
                                   name="email"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Contraseña --}}
                        <div>
                            <label for="create_password" class="block text-sm font-medium text-gray-700 mb-1">
                                Contraseña <span class="text-red-500">*</span>
                            </label>
                            <input type="password"
                                   id="create_password"
                                   name="password"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        {{-- Confirmar Contraseña --}}
                        <div>
                            <label for="create_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                                Confirmar contraseña <span class="text-red-500">*</span>
                            </label>
                            <input type="password"
                                   id="create_password_confirmation"
                                   name="password_confirmation"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                    </div>

                    {{-- Roles y permisos --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Roles y permisos <span class="text-red-500">*</span>
                        </label>
                        <div id="create_spatie_roles" class="space-y-2 max-h-32 overflow-y-auto border border-gray-200 rounded-md p-3">
                            {{-- Los roles se cargarán dinámicamente aquí --}}
                            @foreach ($roles as $role)
                                <label class="inline-flex items-center">
                                    <input type="checkbox"
                                           name="spatie_roles[]"
                                           value="{{ $role->id }}"
                                           class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-600">{{ $role->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p class="mt-1 text-xs text-gray-500">
                            Seleccione los roles que desea asignar al usuario
                        </p>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
                    <button type="button"
                            onclick="closeCreateModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition ease-in-out duration-150">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent active:bg-secondary focus:outline-none focus:border-secondary focus:ring ring-secondary/20 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Crear Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Función para abrir el modal de creación
    function openCreateModal() {
        // Limpiar el formulario
        document.getElementById('createForm').reset();

        // Cargar roles disponibles
        //loadAvailableRoles();

        // Mostrar modal
        document.getElementById('createModal').classList.remove('hidden');
    }

    // Función para cerrar el modal de creación
    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
        // Limpiar el formulario
        document.getElementById('createForm').reset();
    }

    // Función para cargar los roles disponibles
    function loadAvailableRoles() {
        // Hacer una petición AJAX para obtener los roles
        fetch('/usuarios/create', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data && data.roles) {
                displayRolesForCreate(data.roles);
            }
        })
        .catch(error => {
            console.error('Error loading roles:', error);
            // Si falla, usar los roles que ya sabemos que existen
            const defaultRoles = [
                {id: 1, name: 'admin'}
            ];
            displayRolesForCreate(defaultRoles);
        });
    }

    // Función para mostrar los roles en el modal de creación
    function displayRolesForCreate(roles) {
        let rolesHtml = '';
        roles.forEach(role => {
            rolesHtml += `
                <label class="inline-flex items-center">
                    <input type="checkbox"
                           name="spatie_roles[]"
                           value="${role.id}"
                           class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-600">${role.name}</span>
                </label>
            `;
        });

        document.getElementById('create_spatie_roles').innerHTML = rolesHtml;
    }

    // Cerrar modal al hacer clic fuera de él
    document.getElementById('createModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCreateModal();
        }
    });

    // Prevenir que el formulario se cierre al hacer clic dentro del modal
    document.querySelector('#createModal .relative').addEventListener('click', function(e) {
        e.stopPropagation();
    });
</script>
