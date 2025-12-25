{{-- Modal Crear Objetivo Institucional --}}
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 mx-auto p-5 border w-full max-w-3xl shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Crear Nuevo Objetivo Institucional</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="createForm" action="{{ route('objetivos-institucionales.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    {{-- PND --}}
                    <div>
                        <label for="create_idPnd" class="block text-sm font-medium text-gray-700 mb-1">
                            Plan Nacional de Desarrollo <span class="text-red-500">*</span>
                        </label>
                        <select id="create_idPnd"
                                name="idPnd"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                            <option value="">Seleccione un PND...</option>
                            @foreach($pnds as $pnd)
                                <option value="{{ $pnd->idPnd }}">{{ $pnd->eje }} - Obj. {{ $pnd->objetivoN }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- ODS --}}
                    <div>
                        <label for="create_idOds" class="block text-sm font-medium text-gray-700 mb-1">
                            ODS Agenda 2030 <span class="text-red-500">*</span>
                        </label>
                        <select id="create_idOds"
                                name="idOds"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                            <option value="">Seleccione un ODS...</option>
                            @foreach($odss as $ods)
                                <option value="{{ $ods->idOds }}">ODS {{ $ods->odsnum }} - {{ $ods->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Objetivo Estratégico --}}
                    <div>
                        <label for="create_idobjEstrategico" class="block text-sm font-medium text-gray-700 mb-1">
                            Objetivo Estratégico <span class="text-red-500">*</span>
                        </label>
                        <select id="create_idobjEstrategico"
                                name="idobjEstrategico"
                                required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                            <option value="">Seleccione un objetivo...</option>
                            @foreach($objetivosEstrategicos as $objEst)
                                <option value="{{ $objEst->idobjEstrategico }}">
                                    {{ Str::limit($objEst->descripcion, 50) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Nivel de Alineación --}}
                <div class="mb-4">
                    <label for="create_nivel_alineacion" class="block text-sm font-medium text-gray-700 mb-1">
                        Nivel de Alineación <span class="text-red-500">*</span>
                    </label>
                    <select id="create_nivel_alineacion"
                            name="nivel_alineacion"
                            required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                        <option value="">Seleccione un nivel...</option>
                        <option value="Alto">Alto - Alineación directa y significativa</option>
                        <option value="Medio">Medio - Alineación parcial o indirecta</option>
                        <option value="Bajo">Bajo - Alineación mínima o tangencial</option>
                    </select>
                </div>

                {{-- Justificación --}}
                <div class="mb-6">
                    <label for="create_justificacion" class="block text-sm font-medium text-gray-700 mb-1">
                        Justificación
                    </label>
                    <textarea id="create_justificacion"
                              name="justificacion"
                              rows="4"
                              placeholder="Describa la justificación de esta alineación estratégica..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary"></textarea>
                    <p class="mt-1 text-sm text-gray-500">Opcional: Explique cómo estos tres elementos se alinean estratégicamente.</p>
                </div>

                {{-- Botones de acción --}}
                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button"
                            onclick="closeCreateModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors duration-150">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-secondary text-white rounded-md hover:bg-accent focus:outline-none focus:ring-2 focus:ring-secondary transition-colors duration-150">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Crear Objetivo Institucional
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
