{{-- Modal de edición de usuario --}}
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Editar Usuario</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Nombre --}}
                        <div>
                            <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-1">
                                Nombre completo <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="edit_name" 
                                   name="name" 
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="edit_email" class="block text-sm font-medium text-gray-700 mb-1">
                                Correo electrónico <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   id="edit_email" 
                                   name="email" 
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Nueva Contraseña --}}
                        <div>
                            <label for="edit_password" class="block text-sm font-medium text-gray-700 mb-1">
                                Nueva contraseña (opcional)
                            </label>
                            <input type="password" 
                                   id="edit_password" 
                                   name="password"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                            <p class="text-xs text-gray-500 mt-1">Dejar en blanco para mantener la actual</p>
                        </div>

                        {{-- Confirmar Contraseña --}}
                        <div>
                            <label for="edit_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                                Confirmar nueva contraseña
                            </label>
                            <input type="password" 
                                   id="edit_password_confirmation" 
                                   name="password_confirmation"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                    </div>

                    {{-- Roles y permisos --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Roles y permisos <span class="text-red-500">*</span>
                        </label>
                        <div id="edit_spatie_roles" class="space-y-2 max-h-32 overflow-y-auto border border-gray-200 rounded-md p-3">
                            {{-- Los roles se cargarán dinámicamente con JavaScript --}}
                        </div>
                        <p class="mt-1 text-xs text-gray-500">
                            Seleccione los roles que desea asignar al usuario
                        </p>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
                    <button type="button" 
                            onclick="closeEditModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition ease-in-out duration-150">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent active:bg-secondary focus:outline-none focus:border-secondary focus:ring ring-secondary/20 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Actualizar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Variables globales para los roles
    let availableRoles = [];
    let currentUserId = null;

    // Función para abrir el modal de edición
    function openEditModal(usuario) {
        currentUserId = usuario.id;
        
        // Cargar datos del usuario en el formulario
        document.getElementById('edit_name').value = usuario.name;
        document.getElementById('edit_email').value = usuario.email;
        
        // Establecer la acción del formulario
        document.getElementById('editForm').action = `/usuarios/${usuario.id}`;
        
        // Limpiar contraseñas
        document.getElementById('edit_password').value = '';
        document.getElementById('edit_password_confirmation').value = '';
        
        // Cargar roles disponibles via AJAX
        loadUserRoles(usuario.id);
        
        // Mostrar modal
        document.getElementById('editModal').classList.remove('hidden');
    }

    // Función para cerrar el modal de edición
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        currentUserId = null;
    }

    // Función para cargar los roles del usuario via AJAX
    function loadUserRoles(userId) {
        fetch(`/usuarios/${userId}/edit`)
            .then(response => response.json())
            .then(data => {
                availableRoles = data.roles;
                const userRoles = data.usuario_roles;
                
                // Construir HTML para los checkboxes de roles
                let rolesHtml = '';
                data.roles.forEach(role => {
                    const isChecked = userRoles.includes(role.id) ? 'checked' : '';
                    rolesHtml += `
                        <label class="inline-flex items-center">
                            <input type="checkbox" 
                                   name="spatie_roles[]" 
                                   value="${role.id}"
                                   ${isChecked}
                                   class="rounded border-gray-300 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-600">${role.name}</span>
                        </label>
                    `;
                });
                
                document.getElementById('edit_spatie_roles').innerHTML = rolesHtml;
            })
            .catch(error => {
                console.error('Error loading user roles:', error);
                document.getElementById('edit_spatie_roles').innerHTML = '<p class="text-red-500 text-sm">Error al cargar los roles</p>';
            });
    }

    // Cerrar modal al hacer clic fuera de él
    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });

    // Prevenir que el formulario se cierre al hacer clic dentro del modal
    document.querySelector('#editModal .relative').addEventListener('click', function(e) {
        e.stopPropagation();
    });
</script>