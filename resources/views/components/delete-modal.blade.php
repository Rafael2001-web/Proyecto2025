@props(['route', 'title' => 'Confirmar eliminación', 'message' => '¿Estás seguro de que deseas eliminar este elemento?'])

<x-modal name="delete-modal" maxWidth="md">
    <div class="p-6">
        <div class="flex items-center mb-4">
            <div class="flex-shrink-0 w-10 h-10 mx-auto bg-red-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>
        </div>
        
        <div class="text-center">
            <h3 class="text-lg font-semibold text-primary mb-2">
                {{ $title }}
            </h3>
            <p class="text-sm text-neutral mb-6">
                {{ $message }}
            </p>
        </div>

        <div class="flex justify-end space-x-3">
            <x-secondary-button x-on:click="$dispatch('close-modal', 'delete-modal')">
                Cancelar
            </x-secondary-button>
            
            <form id="delete-form" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <x-danger-button type="submit">
                    Eliminar
                </x-danger-button>
            </form>
        </div>
    </div>
</x-modal>

<script>
document.addEventListener('DOMContentLoaded', function() {
    window.openDeleteModal = function(route) {
        document.getElementById('delete-form').action = route;
        window.dispatchEvent(new CustomEvent('open-modal', { detail: 'delete-modal' }));
    }
});
</script>