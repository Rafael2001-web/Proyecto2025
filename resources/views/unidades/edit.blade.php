<x-modal name="edit-unidad-modal" maxWidth="2xl">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-primary">
                Editar Unidad
            </h3>
            <button x-on:click="$dispatch('close-modal', 'edit-unidad-modal')"
                class="text-neutral hover:text-primary transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="edit-unidad-form" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="edit_macrosector" value="Macrosector" />
                    <x-text-input id="edit_macrosector" name="macrosector" type="text" class="mt-1 block w-full" required />
                    <x-input-error class="mt-2" :messages="$errors->get('macrosector')" />
                </div>

                <div>
                    <x-input-label for="edit_sector" value="Sector" />
                    <x-text-input id="edit_sector" name="sector" type="text" class="mt-1 block w-full" required />
                    <x-input-error class="mt-2" :messages="$errors->get('sector')" />
                </div>

                <div>
                    <x-input-label for="edit_estado" value="Estado" />
                    <select id="edit_estado" name="estado"
                        class="mt-1 block w-full border-neutral/30 bg-white text-neutral focus:border-secondary focus:ring-secondary/20 focus:ring-2 rounded-md shadow-sm"
                        required>
                        <option value="">Seleccionar estado</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('estado')" />
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <x-secondary-button type="button" x-on:click="$dispatch('close-modal', 'edit-unidad-modal')">
                    Cancelar
                </x-secondary-button>
                <x-primary-button type="submit">
                    Actualizar Unidad
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>