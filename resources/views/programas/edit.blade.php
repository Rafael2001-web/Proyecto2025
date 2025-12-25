
<x-modal name="edit-programa-modal" maxWidth="2xl">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-primary">
                Editar Programa
            </h3>
            <button x-on:click="$dispatch('close-modal', 'edit-programa-modal')"
                class="text-neutral hover:text-primary transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="edit-programa-form" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <x-input-label for="edit_idEntidad" value="Entidad" />
                    <select id="edit_idEntidad" name="idEntidad"
                        class="mt-1 block w-full border-neutral/30 bg-white text-neutral focus:border-secondary focus:ring-secondary/20 focus:ring-2 rounded-md shadow-sm"
                        required>
                        <option value="">Seleccionar entidad</option>
                        @foreach($entidades ?? [] as $entidad)
                            <option value="{{ $entidad->idEntidad }}">{{ $entidad->subSector }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('idEntidad')" />
                </div>

                <div>
                    <x-input-label for="edit_nombre" value="Nombre" />
                    <x-text-input id="edit_nombre" name="nombre" type="text" class="mt-1 block w-full" required />
                    <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
                </div>

                <div>
                    <x-input-label for="edit_descripcion" value="Descripción" />
                    <textarea id="edit_descripcion" name="descripcion" rows="3"
                        class="mt-1 block w-full border-neutral/30 bg-white text-neutral focus:border-secondary focus:ring-secondary/20 focus:ring-2 rounded-md shadow-sm"
                        required></textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <x-secondary-button type="button" x-on:click="$dispatch('close-modal', 'edit-programa-modal')">
                    Cancelar
                </x-secondary-button>
                <x-primary-button type="submit">
                    Actualizar Programa
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>
