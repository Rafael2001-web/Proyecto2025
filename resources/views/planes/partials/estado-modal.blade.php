{{-- Modal de estado de plan --}}
<div id="estadoModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Estado del Plan</h3>
                <button onclick="closeEstadoModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="estadoForm" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Estado --}}
                        <div>
                            <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">
                                Estado <span class="text-red-500">*</span>
                            </label>
                            <select id="estado"
                                    name="estado"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                                <option value="">Seleccionar estado</option>
                                <option value="Borrador">Borrador</option>
                                <option value="Aprobado">Aprobado</option>
                                <option value="Rechazado">Rechazado</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
                    <button type="button"
                            onclick="closeEstadoModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition ease-in-out duration-150">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent active:bg-secondary focus:outline-none focus:border-secondary focus:ring ring-secondary/20 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Cambiar Estado de Plan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Función para abrir el modal de edición
    function openEstadoModal(plan) {
        // Cargar datos del plan en el formulario
        document.getElementById('estadoForm').action = `/planes/${plan.idPlan}/estado`;
        document.getElementById('estado').value = plan.estado;

        // Mostrar modal
        document.getElementById('estadoModal').classList.remove('hidden');
    }

    // Función para cerrar el modal de edición
    function closeEstadoModal() {
        document.getElementById('estadoModal').classList.add('hidden');
    }

    // Cerrar modal al hacer clic fuera de él
    document.getElementById('estadoModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEstadoModal();
        }
    });

    // Prevenir que el formulario se cierre al hacer clic dentro del modal
    document.querySelector('#estadoModal .relative').addEventListener('click', function(e) {
        e.stopPropagation();
    });
</script>
