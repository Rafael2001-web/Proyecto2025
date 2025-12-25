{{-- Modal Crear Rol --}}
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Crear Nuevo Rol</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="createForm" action="{{ route('roles.store') }}" method="POST">
                @csrf
                
                <div class="space-y-4">
                    {{-- Nombre --}}
                    <div>
                        <label for="create_name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nombre del Rol <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="create_name" 
                               name="name" 
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary"
                               placeholder="Ej: Editor, Moderador, etc.">
                    </div>

                    {{-- Permisos --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Permisos (Opcional)
                        </label>
                        <div id="create-permissions-container" class="max-h-40 overflow-y-auto border border-gray-200 rounded-md p-3 space-y-2">
                            {{-- Los permisos se cargarán dinámicamente --}}
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            Selecciona los permisos que tendrá este rol.
                        </p>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" 
                            onclick="closeCreateModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-primary text-white text-base font-medium rounded-md shadow-sm hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary">
                        Crear Rol
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

