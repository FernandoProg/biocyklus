<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Organización') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg">Formulario de Edición</h3>

                    <form action="{{ route('organizacion.update', $organizacion->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ $organizacion->nombre }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                        </div>

                        <!-- Ubicación -->
                        <div class="mb-4">
                            <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación</label>
                            <input type="text" id="search" placeholder="Buscar dirección" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <input type="hidden" name="ubicacion" id="ubicacion" value="{{ $organizacion->ubicacion }}" required>
                            <div id="map" class="h-64 mt-2"></div>
                        </div>

                        <!-- Número de Miembros -->
                        <div class="mb-4">
                            <label for="miembros" class="block text-sm font-medium text-gray-700">Número de Miembros</label>
                            <input type="number" name="miembros" id="miembros" min="1" value="{{ $organizacion->miembros }}" required class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>

                        <!-- Redes Sociales -->
                        <div class="mb-4">
                            <label for="rrss" class="block text-sm font-medium text-gray-700">Redes Sociales</label>
                            <input type="text" name="rrss" id="rrss" value="{{ $organizacion->rrss }}" required class="mt-1 block w-full border-gray-300 rounded-md">
                        </div>

                        <!-- Compostan -->
                        <div class="mb-4 flex items-center">
                            <input type="checkbox" name="compostan" id="compostan" {{ $organizacion->compostan ? 'checked' : '' }} class="mr-2">
                            <label for="compostan" class="text-sm font-medium text-gray-700">¿Realizan compostaje?</label>
                        </div>

                        <!-- Reciclan -->
                        <div class="mb-4 flex items-center">
                            <input type="checkbox" name="reciclan" id="reciclan" {{ $organizacion->reciclan ? 'checked' : '' }} class="mr-2" onchange="toggleTipoReciclaje(this)">
                            <label for="reciclan" class="text-sm font-medium text-gray-700">¿Realizan reciclaje?</label>
                        </div>

                        <!-- Tipo de Reciclaje -->
                        <div class="mb-4" id="tipoReciclajeContainer" style="{{ $organizacion->reciclan ? '' : 'display: none;' }}">
                            <label for="tipo_reciclaje" class="block text-sm font-medium text-gray-700">Tipos de Reciclaje</label>
                            <select name="tipo_reciclaje[]" id="tipo_reciclaje" multiple class="mt-1 block w-full border-gray-300 rounded-md">
                                @foreach($tiposReciclaje as $tipo)
                                    <option value="{{ $tipo->id }}" {{ $organizacion->tiposReciclajes->contains($tipo->id) ? 'selected' : '' }}>{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Capacitarse -->
                        <div class="mb-4 flex items-center">
                            <input type="checkbox" name="capacitarse" id="capacitarse" {{ $organizacion->capacitarse ? 'checked' : '' }} class="mr-2">
                            <label for="capacitarse" class="text-sm font-medium text-gray-700">¿Interesados en capacitarse?</label>
                        </div>

                        <!-- Tipo de Asociación -->
                        <div class="mb-4">
                            <label for="asociacion" class="block text-sm font-medium text-gray-700">Tipo de Asociación</label>
                            <select name="asociacion" id="asociacion" required class="mt-1 block w-full border-gray-300 rounded-md">
                                <option value="agrupacion de hecho" {{ $organizacion->asociacion == 'agrupacion de hecho' ? 'selected' : '' }}>Agrupación de Hecho</option>
                                <option value="asociacion" {{ $organizacion->asociacion == 'asociacion' ? 'selected' : '' }}>Asociación</option>
                                <option value="corporacion" {{ $organizacion->asociacion == 'corporacion' ? 'selected' : '' }}>Corporación</option>
                                <option value="fundacion" {{ $organizacion->asociacion == 'fundacion' ? 'selected' : '' }}>Fundación</option>
                                <option value="organizacion comunitaria" {{ $organizacion->asociacion == 'organizacion comunitaria' ? 'selected' : '' }}>Organización Comunitaria</option>
                                <option value="pyme o empresa" {{ $organizacion->asociacion == 'pyme o empresa' ? 'selected' : '' }}>Pyme o Empresa</option>
                                <option value="otro" {{ $organizacion->asociacion == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>

                        <!-- Botón de Envío -->
                        <div class="flex items-center justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Actualizar Organización') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Leaflet y Geocoder -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <!-- Script de inicialización de mapa -->
    <script>
        var map = L.map('map').setView([{{ $organizacion->ubicacion ? explode(',', $organizacion->ubicacion)[0] : -33.4489 }}, {{ $organizacion->ubicacion ? explode(',', $organizacion->ubicacion)[1] : -70.6693 }}], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 18 }).addTo(map);

        var marker = L.marker([{{ $organizacion->ubicacion ? explode(',', $organizacion->ubicacion)[0] : -33.4489 }}, {{ $organizacion->ubicacion ? explode(',', $organizacion->ubicacion)[1] : -70.6693 }}], { draggable: true }).addTo(map);

        function updateLocation(lat, lng) {
            document.getElementById('ubicacion').value = lat + ',' + lng;
        }

        marker.on('dragend', function(e) {
            updateLocation(e.target.getLatLng().lat.toFixed(6), e.target.getLatLng().lng.toFixed(6));
        });

        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            updateLocation(e.latlng.lat.toFixed(6), e.latlng.lng.toFixed(6));
        });

        var geocoder = L.Control.Geocoder.nominatim();
        document.getElementById('search').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                geocoder.geocode(this.value, function(results) {
                    if (results.length > 0) {
                        var latLng = results[0].center;
                        marker.setLatLng(latLng);
                        map.setView(latLng, 13);
                        updateLocation(latLng.lat.toFixed(6), latLng.lng.toFixed(6));
                    } else {
                        alert('No se encontraron resultados para la búsqueda.');
                    }
                });
            }
        });

        function toggleTipoReciclaje(checkbox) {
            document.getElementById('tipoReciclajeContainer').style.display = checkbox.checked ? '' : 'none';
        }
    </script>
</x-app-layout>