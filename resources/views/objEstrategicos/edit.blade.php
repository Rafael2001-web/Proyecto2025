<x-modal name="edit-objestrategico-modal" maxWidth="2xl">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-primary">
                Editar Objetivo Estratégico
            </h3>
            <button x-on:click="$dispatch('close-modal', 'edit-objestrategico-modal')"
                class="text-neutral hover:text-primary transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="edit-objestrategico-form" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="edit_nombre" value="Nombre" />
                    <x-text-input id="edit_nombre" name="nombre" type="text" class="mt-1 block w-full" required />
                    <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
                </div>

                <div>
                    <x-input-label for="edit_fechaRegistro" value="Fecha de Registro" />
                    <x-text-input id="edit_fechaRegistro" name="fechaRegistro" type="date" class="mt-1 block w-full" required />
                    <x-input-error class="mt-2" :messages="$errors->get('fechaRegistro')" />
                </div>

                <div>
                    <x-input-label for="edit_estado" value="Estado" />
                    <select id="edit_estado" name="estado"
                        class="mt-1 block w-full border-neutral/30 bg-white text-neutral focus:border-secondary focus:ring-secondary/20 focus:ring-2 rounded-md shadow-sm"
                        required>
                        <option value="">Seleccionar estado</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                        <option value="En Proceso">En Proceso</option>
                        <option value="Completado">Completado</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('estado')" />
                </div>
            </div>

            <div>
                <x-input-label for="edit_descripcion" value="Descripción" />
                <textarea id="edit_descripcion" name="descripcion" rows="3"
                    class="mt-1 block w-full border-neutral/30 bg-white text-neutral focus:border-secondary focus:ring-secondary/20 focus:ring-2 rounded-md shadow-sm"
                    required></textarea>
                <x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <x-secondary-button type="button" x-on:click="$dispatch('close-modal', 'edit-objestrategico-modal')">
                    Cancelar
                </x-secondary-button>
                <x-primary-button type="submit">
                    Actualizar Objetivo Estratégico
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>