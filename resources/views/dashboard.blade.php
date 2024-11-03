<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel de control') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Primera tarjeta: Información del restaurante -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg">Restaurante Asociado</h3>
                    
                    @if(auth()->user()->restaurantes->isNotEmpty())
                        @foreach(auth()->user()->restaurantes as $restaurante)
                            <p><strong>Nombre:</strong> {{ $restaurante->nombre }}</p>
                            <p><strong>Dirección:</strong> {{ $direccionRestaurante ? $direccionRestaurante : 'Ubicación no disponible' }}</p>
                            <p><strong>Teléfono:</strong> {{ $restaurante->telefono }}</p>
                        @endforeach

                        <!-- Botón para ir a la lista de restaurantes -->
                        <a href="{{ route('restaurantes.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('Ver Restaurante') }}
                        </a>
                    @else
                        <p>No tienes restaurante asociado.</p>
                        <a href="{{ route('restaurantes.create') }}" class="text-blue-500">Crear Restaurante</a>
                    @endif
                </div>
            </div>

            <!-- Segunda tarjeta: Información de la organización -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg">Organización Asociada</h3>
                    @if(auth()->user()->organizaciones->isNotEmpty())
                        @foreach(auth()->user()->organizaciones as $organizacion)
                            <p><strong>Nombre:</strong> {{ $organizacion->nombre }}</p>
                            <p><strong>Ubicación:</strong> {{ $direccionOrganizacion ? $direccionOrganizacion : 'Ubicación no disponible' }}</p>
                            <p><strong>Asociación:</strong> {{ $organizacion->asociacion }}</p>

                            <!-- Botón para ir a la lista de organizaciones -->
                            <a href="{{ route('organizacion.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Ver Organización') }}
                            </a>
                        @endforeach
                    @else
                        <p>No tienes una organización asociada.</p>
                        <a href="{{ route('organizacion.create') }}" class="text-blue-500">Crear Organización</a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
