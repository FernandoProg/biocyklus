<!-- resources/views/restaurantes/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Restaurante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg">Formulario de Edición</h3>

                    <form action="{{ route('restaurantes.update', $restaurante->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ $restaurante->nombre }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label for="rubro" class="block text-sm font-medium text-gray-700">Rubro</label>
                            <select name="rubro" id="rubro" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Seleccione un rubro</option>
                                <option value="alimentacion institucional" {{ $restaurante->rubro == 'alimentacion institucional' ? 'selected' : '' }}>Alimentación Institucional</option>
                                <option value="bebidas" {{ $restaurante->rubro == 'bebidas' ? 'selected' : '' }}>Bebidas</option>
                                <option value="carnica" {{ $restaurante->rubro == 'carnica' ? 'selected' : '' }}>Cárnica</option>
                                <option value="comida rapida" {{ $restaurante->rubro == 'comida rapida' ? 'selected' : '' }}>Comida Rápida</option>
                                <option value="lacteos" {{ $restaurante->rubro == 'lacteos' ? 'selected' : '' }}>Lácteos</option>
                                <option value="panificadora" {{ $restaurante->rubro == 'panificadora' ? 'selected' : '' }}>Panificadora</option>
                                <option value="pesquera" {{ $restaurante->rubro == 'pesquera' ? 'selected' : '' }}>Pesquera</option>
                                <option value="restauracion" {{ $restaurante->rubro == 'restauracion' ? 'selected' : '' }}>Restauración</option>
                                <option value="otro" {{ $restaurante->rubro == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" value="{{ $restaurante->telefono }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="gestion" class="block text-sm font-medium text-gray-700">Gestión</label>
                            <select name="gestion" id="gestion" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Seleccione un tipo de gestión</option>
                                <option value="BPA" {{ $restaurante->gestion == 'BPA' ? 'selected' : '' }}>BPA</option>
                                <option value="BPM" {{ $restaurante->gestion == 'BPM' ? 'selected' : '' }}>BPM</option>
                                <option value="BRC" {{ $restaurante->gestion == 'BRC' ? 'selected' : '' }}>BRC</option>
                                <option value="FSA" {{ $restaurante->gestion == 'FSA' ? 'selected' : '' }}>FSA</option>
                                <option value="FSSC" {{ $restaurante->gestion == 'FSSC' ? 'selected' : '' }}>FSSC</option>
                                <option value="HACCP" {{ $restaurante->gestion == 'HACCP' ? 'selected' : '' }}>HACCP</option>
                                <option value="IFS food" {{ $restaurante->gestion == 'IFS food' ? 'selected' : '' }}>IFS food</option>
                                <option value="ISO" {{ $restaurante->gestion == 'ISO' ? 'selected' : '' }}>ISO</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Tipo de Residuos</label>
                            @foreach($tiposResiduos as $tipo)
                                <div class="flex items-center">
                                    <input type="checkbox" name="tipos_residuo[]" id="tipo_{{ $tipo->id }}" value="{{ $tipo->id }}" 
                                        @if($restaurante->tiposResiduos->contains($tipo->id)) checked @endif>
                                    <label for="tipo_{{ $tipo->id }}" class="ml-2">{{ $tipo->nombre }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="ml-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Actualizar Restaurante') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
