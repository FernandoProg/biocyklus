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
                        <table class="min-w-full divide-y divide-gray-200">
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
                                                    <li>{{ $tipo->nombre }}</li> <!-- Asegúrate de que 'nombre' sea el atributo correcto -->
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
                    @else
                        <p>No tienes un restaurante asociado.</p>
                        <a href="{{ route('restaurantes.create') }}" class="text-blue-500">Crear Restaurante</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
