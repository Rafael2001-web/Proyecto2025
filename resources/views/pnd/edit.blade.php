<x-modal name="edit-pnd-modal" maxWidth="2xl">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-primary">
                Editar Objetivo PND
            </h3>
            <button x-on:click="$dispatch('close-modal', 'edit-pnd-modal')"
                class="text-neutral hover:text-primary transition-colors duration-150">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="edit-pnd-form" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="edit_eje" value="Eje" />
                    <select id="edit_eje" name="eje"
                        class="mt-1 block w-full border-neutral/30 bg-white text-neutral focus:border-secondary focus:ring-secondary/20 focus:ring-2 rounded-md shadow-sm"
                        required>
                        <option value="">Seleccione un eje</option>
                        <option value="EJE Social">EJE Social</option>
                        <option value="EJE Desarrollo económico">EJE Desarrollo económico</option>
                        <option value="EJE Infraestructura">EJE Infraestructura</option>
                        <option value="EJE Institucional">EJE Institucional</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('eje')" />
                </div>

                <div>
                    <x-input-label for="edit_objetivoN" value="# Objetivo Nacional" />
                    <x-text-input id="edit_objetivoN" name="objetivoN" type="number" class="mt-1 block w-full" required />
                    <x-input-error class="mt-2" :messages="$errors->get('objetivoN')" />
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
                <x-secondary-button type="button" x-on:click="$dispatch('close-modal', 'edit-pnd-modal')">
                    Cancelar
                </x-secondary-button>
                <x-primary-button type="submit">
                    Actualizar Objetivo PND
                </x-primary-button>
            </div>
        </form>
    </div>
</x-modal>