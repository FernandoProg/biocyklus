<!-- resources/views/organizaciones/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Información de la Organización') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if($organizacion)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ubicación</th>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Miembros</th>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacitación</th>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asociación</th>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipos de Reciclaje</th>
                                    <th class="px-2 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-2 py-4 whitespace-nowrap">{{ $organizacion->nombre }}</td>
                                    <td class="px-2 py-4 whitespace-nowrap overflow-hidden overflow-ellipsis max-w-xs">
                                        {{ $direccionOrganizacion }}
                                    </td>
                                    <td class="px-2 py-4 whitespace-nowrap">{{ $organizacion->miembros }}</td>
                                    <td class="px-2 py-4 whitespace-nowrap">{{ $organizacion->capacitarse ? 'Sí' : 'No' }}</td>
                                    <td class="px-2 py-4 whitespace-nowrap">{{ $organizacion->asociacion }}</td>
                                    <td class="px-2 py-4 whitespace-nowrap">
                                        @if($tiposReciclaje->isEmpty())
                                            No hay tipos de reciclaje asociados.
                                        @else
                                            <ul>
                                                @foreach($tiposReciclaje as $tipo)
                                                    <li>{{ $tipo->nombre }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('organizacion.edit', $organizacion->id) }}" class="text-blue-500 hover:text-blue-700">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('organizacion.destroy', $organizacion->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-blue-500 hover:text-blue-700" onclick="return confirm('¿Estás seguro de que quieres eliminar esta organización?');">
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
                            <a href="{{ route('organizacion.createParticipant') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                                Agregar Participante
                            </a>
                        </div>

                        <!-- Tabla de Participantes -->
                        <table class="min-w-full divide-y divide-gray-200 mb-6">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cargo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($participantes as $participante)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $participante->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $participante->cargo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $participante->email }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hay participantes asociados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @else
                        <p>No tienes una organización asociada.</p>
                        <a href="{{ route('organizacion.create') }}" class="text-blue-500">Crear Organización</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
