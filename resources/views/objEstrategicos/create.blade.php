<x-app-layout>
@section('title','Nuevo Objetivo Estrégico')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Crear Objetivo Estratégico') }}
        </h2>
    </x-slot>
    @if ($errors->any())
        <div>

            <ul>

                @foreach($errors->all() as $error)

                <li> - {{$error}} </li>

                @endforeach

            </ul>

        </div>
    @endif

        {{-- Formulario para la creación de Objetivos Estrégicos--}}

        <form action="{{ route ('objEstrategicos.store')}}" method="POST" class="space-y-4">
            @csrf
        
            <div>
                <label class="block">Fecha de Registro</label>
                <input type="date" name="fechaRegistro" require value="{{ old('fechaRegistro') }}">
            </div>

            <div>
                <label class="block">Descripción</label>
                <input type="text" name="descripcion" require value="{{ old('descripcion') }}">
            </div>

            <div>
                <label class="block">Estado</label>
                <input type="text" name="estado" require value="{{ old('estado') }}">
                
            </div>

            <button type="submit">Guardar</button>

            <a href="{{route('entidades.index')}}">Volver</a>
            
        </form>
</x-app-layout>