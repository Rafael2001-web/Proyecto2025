{{-- Modal de creación de proyecto --}}
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Crear Nuevo Proyecto</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="createForm" action="{{ route('proyectos.store') }}" method="POST">
                @csrf
                
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Código --}}
                        <div>
                            <label for="create_codigo" class="block text-sm font-medium text-gray-700 mb-1">
                                Código del Proyecto
                            </label>
                            <input type="text" 
                                   id="create_codigo" 
                                   name="codigo" 
                                   placeholder="Se genera automáticamente si se deja vacío"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        {{-- Nombre --}}
                        <div>
                            <label for="create_nombre" class="block text-sm font-medium text-gray-700 mb-1">
                                Nombre del Proyecto <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="create_nombre" 
                                   name="nombre" 
                                   required
                                   placeholder="Ingrese el nombre del proyecto"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Sector --}}
                        <div>
                            <label for="create_sector" class="block text-sm font-medium text-gray-700 mb-1">
                                Sector <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="create_sector" 
                                   name="sector" 
                                   required
                                   placeholder="Ingrese el sector"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        {{-- Presupuesto --}}
                        <div>
                            <label for="create_presupuesto" class="block text-sm font-medium text-gray-700 mb-1">
                                Presupuesto <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="create_presupuesto" 
                                   name="presupuesto" 
                                   step="0.01"
                                   min="0"
                                   required
                                   placeholder="0.00"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Estado --}}
                        <div>
                            <label for="create_estado" class="block text-sm font-medium text-gray-700 mb-1">
                                Estado <span class="text-red-500">*</span>
                            </label>
                            <select id="create_estado" 
                                    name="estado" 
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                                <option value="">Seleccionar estado</option>
                                <option value="planificado">Planificado</option>
                                <option value="aprobado">Aprobado</option>
                                <option value="En Ejecución">En Ejecución</option>
                                <option value="completado">Completado</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                        </div>

                        {{-- Usuario --}}
                        <div>
                            <label for="create_user_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Usuario Responsable <span class="text-red-500">*</span>
                            </label>
                            <select id="create_user_id" 
                                    name="user_id" 
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                                <option value="">Seleccionar usuario</option>
                                @foreach(\App\Models\User::all() as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Fecha Inicio --}}
                        <div>
                            <label for="create_fecha_inicio" class="block text-sm font-medium text-gray-700 mb-1">
                                Fecha de Inicio <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   id="create_fecha_inicio" 
                                   name="fecha_inicio" 
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        {{-- Fecha Fin --}}
                        <div>
                            <label for="create_fecha_fin" class="block text-sm font-medium text-gray-700 mb-1">
                                Fecha de Fin <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   id="create_fecha_fin" 
                                   name="fecha_fin" 
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                    </div>

                    {{-- Descripción --}}
                    <div>
                        <label for="create_descripcion" class="block text-sm font-medium text-gray-700 mb-1">
                            Descripción <span class="text-red-500">*</span>
                        </label>
                        <textarea id="create_descripcion" 
                                  name="descripcion" 
                                  rows="4"
                                  required
                                  placeholder="Ingrese la descripción del proyecto"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary"></textarea>
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
                        Crear Proyecto
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
        
        // Mostrar modal
        document.getElementById('createModal').classList.remove('hidden');
    }

    // Función para cerrar el modal de creación
    function closeCreateModal() {
        document.getElementById('createModal').classList.add('hidden');
        // Limpiar el formulario
        document.getElementById('createForm').reset();
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
