<x-modal name="edit-entidad-modal" maxWidth="2xl">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-primary">
                Editar Entidad
            </h3>
            <button x-on:click="$dispatch('close-modal', 'edit-entidad-modal')"
                class="text-neutral hover:text-primary transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="edit-entidad-form" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="edit_codigo" value="Código" />
                    <x-text-input id="edit_codigo" name="codigo" type="number" class="mt-1 block w-full" required />
                    <x-input-error class="mt-2" :messages="$errors->get('codigo')" />
                </div>

                <div>
                    <x-input-label for="edit_subSector" value="Subsector" />
                    <x-text-input id="edit_subSector" name="subSector" type="text" class="mt-1 block w-full"
                        required />
                    <x-input-error class="mt-2" :messages="$errors->get('subSector')" />
                </div>

                <div>
                    <x-input-label for="edit_nivelGobierno" value="Nivel de Gobierno" />
                    <x-text-input id="edit_nivelGobierno" name="nivelGobierno" type="text" class="mt-1 block w-full"
                        required />
                    <x-input-error class="mt-2" :messages="$errors->get('nivelGobierno')" />
                </div>

                <div>
                    <x-input-label for="edit_estado" value="Estado" />
                    <select id="edit_estado" name="estado"
                        class="mt-1 block w-full border-neutral/30 bg-white text-neutral focus:border-secondary focus:ring-secondary/20 focus:ring-2 rounded-md shadow-sm"
                        required>
                        <option value="">Seleccionar estado</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                        <option value="En Reorganización">En Reorganización</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('estado')" />
                </div>

                <div>
                    <x-input-label for="edit_fechaCreacion" value="Fecha de Creación" />
                    <x-text-input id="edit_fechaCreacion" name="fechaCreacion" type="date" class="mt-1 block w-full"
                        required />
                    <x-input-error class="mt-2" :messages="$errors->get('fechaCreacion')" />
                </div>

                <div>
                    <x-input-label for="edit_fechaActualizacion" value="Fecha de Actualización" />
                    <x-text-input id="edit_fechaActualizacion" name="fechaActualizacion" type="date"
                        class="mt-1 block w-full" required />
                    <x-input-error class="mt-2" :messages="$errors->get('fechaActualizacion')" />
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t border-neutral/20">
                <x-secondary-button x-on:click="$dispatch('close-modal', 'edit-entidad-modal')">
                    Cancelar
                </x-secondary-button>

                <x-primary-button type="submit">
                    Actualizar Entidad
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.openEditModal = function(entidad) {
            // Llenar el formulario con los datos de la entidad
            document.getElementById('edit_codigo').value = entidad.codigo || '';
            document.getElementById('edit_subSector').value = entidad.subSector || '';
            document.getElementById('edit_nivelGobierno').value = entidad.nivelGobierno || '';
            document.getElementById('edit_estado').value = entidad.estado || '';
            document.getElementById('edit_fechaCreacion').value = entidad.fechaCreacion || '';
            document.getElementById('edit_fechaActualizacion').value = entidad.fechaActualizacion || '';

            // Configurar la acción del formulario
            document.getElementById('edit-entidad-form').action = `/entidades/${entidad.idEntidad}`;

            // Abrir el modal
            window.dispatchEvent(new CustomEvent('open-modal', {
                detail: 'edit-entidad-modal'
            }));
        }
    });
</script>