{{-- Modal de edición de actividad --}}
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Editar Actividad</h3>
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
                        <div>
                            <label for="edit_proyecto_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Proyecto <span class="text-red-500">*</span>
                            </label>
                            <select id="edit_proyecto_id" name="proyecto_id" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                                <option value="">Seleccionar proyecto</option>
                                @foreach(\App\Models\Proyecto::all() as $proyecto)
                                    <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="edit_codigo" class="block text-sm font-medium text-gray-700 mb-1">
                                Código de Actividad
                            </label>
                            <input type="text"
                                   id="edit_codigo"
                                   name="codigo"
                                   readonly
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="edit_nombre" class="block text-sm font-medium text-gray-700 mb-1">
                                Nombre <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="edit_nombre"
                                   name="nombre"
                                   required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                      
                    <div>
                        <label for="edit_estado" class="block text-sm font-medium text-gray-700 mb-1">
                            Estado Activo/Inactivo <span class="text-red-500">*</span>
                        </label>
                        <select id="edit_estado" 
                                name="estado" 
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                            <option value="">Seleccionar estado...</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>

                        <div>
                            <label for="edit_responsable" class="block text-sm font-medium text-gray-700 mb-1">
                                Responsable
                            </label>
                            <input type="text"
                                   id="edit_responsable"
                                   name="responsable"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                    </div>

                    <div>
                        <label for="edit_descripcion" class="block text-sm font-medium text-gray-700 mb-1">
                            Descripción
                        </label>
                        <textarea id="edit_descripcion" name="descripcion" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="edit_estado" class="block text-sm font-medium text-gray-700 mb-1">
                                Estado Avance <span class="text-red-500">*</span>
                            </label>
                            <select id="edit_estado" name="estado" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                                <option value="PLANIFICADA">PLANIFICADA</option>
                                <option value="EN_PROGRESO">EN PROGRESO</option>
                                <option value="COMPLETADA">COMPLETADA</option>
                            </select>
                        </div>

                        <div>
                            <label for="edit_prioridad" class="block text-sm font-medium text-gray-700 mb-1">
                                Prioridad (1-5) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" id="edit_prioridad" name="prioridad" min="1" max="5" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        <div>
                            <label for="edit_avance_planificado" class="block text-sm font-medium text-gray-700 mb-1">
                                Avance Planificado (%)
                            </label>
                            <input type="number" id="edit_avance_planificado" name="avance_planificado" step="0.01" min="0" max="100"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="edit_fecha_inicio_planificada" class="block text-sm font-medium text-gray-700 mb-1">
                                Fecha Inicio Planificada <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="edit_fecha_inicio_planificada" name="fecha_inicio_planificada" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        <div>
                            <label for="edit_fecha_fin_planificada" class="block text-sm font-medium text-gray-700 mb-1">
                                Fecha Fin Planificada <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="edit_fecha_fin_planificada" name="fecha_fin_planificada" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="edit_fecha_inicio_real" class="block text-sm font-medium text-gray-700 mb-1">
                                Fecha Inicio Real
                            </label>
                            <input type="date" id="edit_fecha_inicio_real" name="fecha_inicio_real"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        <div>
                            <label for="edit_fecha_fin_real" class="block text-sm font-medium text-gray-700 mb-1">
                                Fecha Fin Real
                            </label>
                            <input type="date" id="edit_fecha_fin_real" name="fecha_fin_real"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>

                        <div>
                            <label for="edit_avance_real" class="block text-sm font-medium text-gray-700 mb-1">
                                Avance Real (%)
                            </label>
                            <input type="number" id="edit_avance_real" name="avance_real" step="0.01" min="0" max="100"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        </div>
                    </div>

                    <div>
                        <label for="edit_objetivos_estrategicos" class="block text-sm font-medium text-gray-700 mb-1">
                            Objetivos Estratégicos <span class="text-red-500">*</span>
                        </label>
                        <select id="edit_objetivos_estrategicos" name="objetivos_estrategicos[]" multiple required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                            @foreach(\App\Models\objEstrategico::all() as $objetivo)
                                <option value="{{ $objetivo->idobjEstrategico }}">{{ $objetivo->descripcion }}</option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Mantén presionada Ctrl (o Cmd) para seleccionar múltiples.</p>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition ease-in-out duration-150">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent active:bg-secondary focus:outline-none focus:border-secondary focus:ring ring-secondary/20 disabled:opacity-25 transition ease-in-out duration-150 shadow-sm">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Actualizar Actividad
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>