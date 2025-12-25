{{-- Modal Crear Entidad --}}
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Crear Nueva Entidad</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="createForm" action="{{ route('entidades.store') }}" method="POST">
                @csrf
                
                <div class="space-y-4">
                    {{-- Código --}}
                    <div>
                        <label for="create_codigo" class="block text-sm font-medium text-gray-700 mb-1">
                            Código <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="create_codigo" 
                               name="codigo" 
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary"
                               placeholder="Ej: ENT001">
                    </div>

                    {{-- Sub Sector --}}
                    <div>
                        <label for="create_subSector" class="block text-sm font-medium text-gray-700 mb-1">
                            Sub Sector <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="create_subSector" 
                               name="subSector" 
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary"
                               placeholder="Ej: Educación, Salud, etc.">
                    </div>

                    {{-- Nivel de Gobierno --}}
                    <div>
                        <label for="create_nivelGobierno" class="block text-sm font-medium text-gray-700 mb-1">
                            Nivel de Gobierno <span class="text-red-500">*</span>
                        </label>
                        <select id="create_nivelGobierno" 
                                name="nivelGobierno" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                            <option value="">Seleccionar nivel...</option>
                            <option value="Nacional">Nacional</option>
                            <option value="Regional">Regional</option>
                            <option value="Local">Local</option>
                        </select>
                    </div>

                    {{-- Estado --}}
                    <div>
                        <label for="create_estado" class="block text-sm font-medium text-gray-700 mb-1">
                            Estado <span class="text-red-500">*</span>
                        </label>
                        <select id="create_estado" 
                                name="estado" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                            <option value="">Seleccionar estado...</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>

                    {{-- Fecha de Creación --}}
                    <div>
                        <label for="create_fechaCreacion" class="block text-sm font-medium text-gray-700 mb-1">
                            Fecha de Creación
                        </label>
                        <input type="date" 
                               id="create_fechaCreacion" 
                               name="fechaCreacion"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
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
                        Crear Entidad
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>