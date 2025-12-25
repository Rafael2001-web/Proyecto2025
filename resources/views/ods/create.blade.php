
<x-app-layout>

    @section('title', 'Nuevo ODS')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Crear ODS') }}
        </h2>
    </x-slot>
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

    <form action="{{ route('ods.store') }}" method="POST" class="space-y-4">
        @csrf

        {{--
            <div>
                <label class="block">ID</label>
                <input type="number" name="idOds" require value="{{ old('idOds') }}">
            </div> --}}

        <div>
            <label class="block"># ODS</label>
            <input type="number" name="odsnum" require value="{{ old('odsnum') }}">
        </div>

        <div>
            <label class="block">Nombre ODS</label>
            <input type="text" name="nombre" require value="{{ old('nombre') }}">
        </div>

        <div>
            <label class="block">Descripción</label>
            <input type="text" name="descripcion" require value="{{ old('sector') }}">
        </div>
        <button type="submit">Guardar</button>

        <a href="{{ route('ods.index') }}">Volver</a>
    </form>
</x-app-layout>
