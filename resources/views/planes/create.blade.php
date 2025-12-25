
<x-app-layout>
@section('title','Nuevo Plan')

    <h2 class="text-2xl font-bold mb-4">Crear Planes:</h2>
    
    @if ($errors->any())
        <div>

            <ul>

                @foreach($errors->all() as $error)

                <li> - {{$error}} </li>

                @endforeach

            </ul>

        </div>
    @endif

        {{-- Formulario para la creación de planes --}}

        <form action="{{ route ('planes.store')}}" method="POST" class="space-y-4">
            @csrf

        
             <div>
                <label class="block">Nombre</label>
                <input type="text" name="nombre" require value="{{ old('nombre') }}">
            </div>

             <div>
                <label class="block">Entidad</label>
                <input type="text" name="entidad" require value="{{ old('entidad') }}">
            </div>

            <div>
                <label>Presupuesto ($)</label>
                <input type="number" name="presupuesto" step="0.01" require value="{{ old('presupuesto') }}">
            </div>
                
                
             <div>
                <label class="block">Fecha Inicial</label>
                <input type="date" name="fecha_inicio" require value="{{ old('fecha_inicio') }}">
            </div>

             <div>
                <label class="block">Fecha Final</label>
                <input type="date" name="fecha_fin" require value="{{ old('fecha_fin') }}">
            </div>

            <div class="form-group">
            <label>Estado</label>
            <select name="estado" class="form-control" required>
                <option value="">Seleccione el estado</option>
                <option value="Borrador" {{ (old('estado',  '') == 'Borrador') ? 'selected' : '' }}>Borrador</option>
                <option value="En Revision" {{ (old('estado', '') == 'En Revision') ? 'selected' : '' }}>En Revisión</option>
                <option value="Aprobado" {{ (old('estado', '') == 'Aprobado') ? 'selected' : '' }}>Aprobado</option>
                 <option value="Rechazado" {{ (old('estado', '') == 'Rechazado') ? 'selected' : '' }}>Rechazado</option>
            </select>
            </div>    

            <button type="submit">Guardar</button>

            <a href="{{route('planes.index')}}">Volver</a>
            
        </form>

</x-app-layout>
