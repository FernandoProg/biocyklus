<h3 class="text-lg font-semibold mt-6">Empleados</h3>
@if($restaurante->empleados->isEmpty())
    <p>No hay empleados registrados.</p>
@else
    <ul>
        @foreach($restaurante->empleados as $empleado)
            <li>{{ $empleado->nombre }} - {{ $empleado->correo }}</li>
        @endforeach
    </ul>
@endif
