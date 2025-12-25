{{-- Modal Editar Objetivo PND --}}
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Editar Objetivo PND</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    {{-- EJE --}}
                    <div>
                        <label for="edit_eje" class="block text-sm font-medium text-gray-700 mb-1">
                            EJE <span class="text-red-500">*</span>
                        </label>
                        <select id="edit_eje" 
                                name="eje" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                            <option value="">Seleccione un eje...</option>
                            <option value="EJE Social">EJE Social</option>
                            <option value="EJE Desarrollo económico">EJE Desarrollo económico</option>
                            <option value="EJE Infraestructura">EJE Infraestructura</option>
                            <option value="EJE Institucional">EJE Institucional</option>
                            <option value="EJE Gestion de Riesgos">EJE Gestion de Riesgos</option>
                        </select>
                    </div>

                    {{-- Objetivo Nacional --}}
                    <div>
                        <label for="edit_objetivoN" class="block text-sm font-medium text-gray-700 mb-1">
                            # Objetivo Nacional <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               id="edit_objetivoN" 
                               name="objetivoN" 
                               required
                               min="1"
                               placeholder="Ej: 1, 2, 3..."
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                    </div>
                </div>

                {{-- Descripión --}}
                <div class="mb-6">
                    <label for="edit_descripcion" class="block text-sm font-medium text-gray-700 mb-1">
                        Descripción <span class="text-red-500">*</span>
                    </label>
                    <textarea id="edit_descripcion" 
                              name="descripcion" 
                              required
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary"
                              placeholder="Ingrese la descripción del objetivo del Plan Nacional de Desarrollo..."></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeEditModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-primary text-white text-base font-medium rounded-md shadow-sm hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary">
                        Actualizar Objetivo PND
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>