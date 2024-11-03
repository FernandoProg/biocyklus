<!-- resources/views/restaurantes/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Información del restaurante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if($restaurante)
                        <table class="min-w-full divide-y divide-gray-200 mb-6">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rubro</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ubicación</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gestión</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo de Residuos</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $restaurante->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $restaurante->rubro }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $restaurante->telefono }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">
                                        {{ $direccionRestaurante }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $restaurante->gestion }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($tiposResiduos->isEmpty())
                                            No hay tipos de residuos asociados.
                                        @else
                                            <ul>
                                                @foreach($tiposResiduos as $tipo)
                                                    <li>{{ $tipo->nombre }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('restaurantes.edit', $restaurante->id) }}" class="text-blue-500 hover:text-blue-700">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('restaurantes.destroy', $restaurante->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-blue-500 hover:text-blue-700" onclick="return confirm('¿Estás seguro de que quieres eliminar este restaurante?');">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Sección de Empleados y Botón Agregar Empleado -->
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="font-semibold text-lg">Empleados</h3>
                            <a href="{{ route('restaurante.createEmployee') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                                Agregar Empleado
                            </a>
                        </div>

                        <!-- Tabla de Empleados -->
                        <table class="min-w-full divide-y divide-gray-200 mb-6">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cargo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($empleados as $empleado)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $empleado->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $empleado->cargo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $empleado->email }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hay empleados asociados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @else
                        <p>No tienes un restaurante asociado.</p>
                        <a href="{{ route('restaurantes.create') }}" class="text-blue-500">Crear Restaurante</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
