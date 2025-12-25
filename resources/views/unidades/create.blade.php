
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Crear Unidades') }}
        </h2>
    </x-slot>
    @section('title', 'Nueva Unidad')

    @if ($errors->any())
        <div>

            <ul>

                @foreach ($errors->all() as $error)
                    <li> - {{ $error }} </li>
                @endforeach

            </ul>

        </div>
    @endif

    {{-- Formulario para la creación de unidades --}}

    <form action="{{ route('unidades.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block">Macrosector</label>
            <input type="text" name="macrosector" require value="{{ old('macrosector') }}">
        </div>
        <div>
            <label class="block">Sector</label>
            <input type="text" name="sector" require value="{{ old('sector') }}">
        </div>
        <div>
            <label class="block">Estado</label>
            <input type="text" name="estado" require value="{{ old('estado') }}">
        </div>
        <button type="submit">Guardar</button>

        <a href="{{ route('unidades.index') }}">Volver</a>

    </form>
</x-app-layout>
