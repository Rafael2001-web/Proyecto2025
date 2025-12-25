{{-- Modal Crear ODS --}}
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Crear Nuevo Objetivo ODS</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="createForm" action="{{ route('ods.store') }}" method="POST">
                @csrf
                
                <div class="space-y-4">
                    {{-- Número ODS --}}
                    <div>
                        <label for="create_odsnum" class="block text-sm font-medium text-gray-700 mb-1">
                            Número ODS <span class="text-red-500">*</span>
                        </label>
                        <select id="create_odsnum" 
                                name="odsnum" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                            <option value="">Seleccionar ODS...</option>
                            <option value="1">ODS 1 - Fin de la pobreza</option>
                            <option value="2">ODS 2 - Hambre cero</option>
                            <option value="3">ODS 3 - Salud y bienestar</option>
                            <option value="4">ODS 4 - Educación de calidad</option>
                            <option value="5">ODS 5 - Igualdad de género</option>
                            <option value="6">ODS 6 - Agua limpia y saneamiento</option>
                            <option value="7">ODS 7 - Energía asequible y no contaminante</option>
                            <option value="8">ODS 8 - Trabajo decente y crecimiento económico</option>
                            <option value="9">ODS 9 - Industria, innovación e infraestructura</option>
                            <option value="10">ODS 10 - Reducción de las desigualdades</option>
                            <option value="11">ODS 11 - Ciudades y comunidades sostenibles</option>
                            <option value="12">ODS 12 - Producción y consumo responsables</option>
                            <option value="13">ODS 13 - Acción por el clima</option>
                            <option value="14">ODS 14 - Vida submarina</option>
                            <option value="15">ODS 15 - Vida de ecosistemas terrestres</option>
                            <option value="16">ODS 16 - Paz, justicia e instituciones sólidas</option>
                            <option value="17">ODS 17 - Alianzas para lograr los objetivos</option>
                        </select>
                    </div>

                    {{-- Nombre --}}
                    <div>
                        <label for="create_nombre" class="block text-sm font-medium text-gray-700 mb-1">
                            Nombre <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="create_nombre" 
                               name="nombre" 
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary"
                               placeholder="Ej: Fin de la pobreza">
                    </div>

                    {{-- Descripción --}}
                    <div>
                        <label for="create_descripcion" class="block text-sm font-medium text-gray-700 mb-1">
                            Descripción <span class="text-red-500">*</span>
                        </label>
                        <textarea id="create_descripcion" 
                                  name="descripcion" 
                                  required
                                  rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary"
                                  placeholder="Descripción detallada del objetivo ODS..."></textarea>
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
                        Crear Objetivo ODS
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>