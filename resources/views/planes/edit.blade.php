<x-modal name="edit-plan-modal" maxWidth="2xl">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-primary">
                Editar Plan
            </h3>
            <button x-on:click="$dispatch('close-modal', 'edit-plan-modal')"
                class="text-neutral hover:text-primary transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="edit-plan-form" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="edit_nombre" value="Nombre" />
                    <x-text-input id="edit_nombre" name="nombre" type="text" class="mt-1 block w-full" required />
                    <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
                </div>

                <div>
                    <x-input-label for="edit_entidad" value="Entidad" />
                    <x-text-input id="edit_entidad" name="entidad" type="text" class="mt-1 block w-full" required />
                    <x-input-error class="mt-2" :messages="$errors->get('entidad')" />
                </div>

                <div>
                    <x-input-label for="edit_presupuesto" value="Presupuesto ($)" />
                    <x-text-input id="edit_presupuesto" name="presupuesto" type="number" step="0.01" class="mt-1 block w-full" required />
                    <x-input-error class="mt-2" :messages="$errors->get('presupuesto')" />
                </div>

                <div>
                    <x-input-label for="edit_estado" value="Estado" />
                    <select id="edit_estado" name="estado"
                        class="mt-1 block w-full border-neutral/30 bg-white text-neutral focus:border-secondary focus:ring-secondary/20 focus:ring-2 rounded-md shadow-sm"
                        required>
                        <option value="">Seleccione el estado</option>
                        <option value="Borrador">Borrador</option>
                        <option value="En Revision">En Revisión</option>
                        <option value="Aprobado">Aprobado</option>
                        <option value="Rechazado">Rechazado</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('estado')" />
                </div>

                <div>
                    <x-input-label for="edit_fecha_inicio" value="Fecha Inicial" />
                    <x-text-input id="edit_fecha_inicio" name="fecha_inicio" type="date" class="mt-1 block w-full" required />
                    <x-input-error class="mt-2" :messages="$errors->get('fecha_inicio')" />
                </div>

                <div>
                    <x-input-label for="edit_fecha_fin" value="Fecha Final" />
                    <x-text-input id="edit_fecha_fin" name="fecha_fin" type="date" class="mt-1 block w-full" required />
                    <x-input-error class="mt-2" :messages="$errors->get('fecha_fin')" />
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <x-secondary-button type="button" x-on:click="$dispatch('close-modal', 'edit-plan-modal')">
                    Cancelar
                </x-secondary-button>
                <x-primary-button type="submit">
                    Actualizar Plan
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>