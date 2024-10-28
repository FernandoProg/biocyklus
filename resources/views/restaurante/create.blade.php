<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Restaurante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg">Información del Restaurante</h3>
                    <form method="POST" action="{{ route('payment.create') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input type="text" name="nombre" id="nombre" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                            @error('nombre')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="rubro" class="block text-sm font-medium text-gray-700">Rubro</label>
                            <select name="rubro" id="rubro" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Seleccione un rubro</option>
                                <option value="lacteos">Lácteos</option>
                                <option value="comida rapida">Comida Rápida</option>
                                <option value="restauracion">Restauración</option>
                                <option value="alimentacion institucional">Alimentación Institucional</option>
                                <option value="panificadora">Panificadora</option>
                                <option value="carnica">Cárnica</option>
                                <option value="pesquera">Pesquera</option>
                                <option value="bebidas">Bebidas</option>
                                <option value="otro">Otro</option>
                            </select>
                            @error('rubro')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
                            @error('telefono')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="ubicacion" class="block text-sm font-medium text-gray-700">Ubicación</label>
                            <input type="text" id="search" placeholder="Buscar dirección" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"/>
                            <input type="hidden" name="ubicacion" id="ubicacion" required />
                            <input type="hidden" name="negocio" id="negocio" value="Restaurante" required />
                            <input type="hidden" name="amount" id="amount" value="19990" required />
                            <input type="hidden" name="session_id" value="{{ Auth::user()->id }}">
                            <div id="map" class="h-64 mt-2"></div>
                            @error('ubicacion')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="gestion" class="block text-sm font-medium text-gray-700">Gestión</label>
                            <select name="gestion" id="gestion" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">Seleccione un tipo de gestión</option>
                                <option value="BPM">BPM</option>
                                <option value="HACCP">HACCP</option>
                                <option value="ISO">ISO</option>
                                <option value="BRC">BRC</option>
                                <option value="IFS food">IFS food</option>
                                <option value="BPA">BPA</option>
                                <option value="FSSC">FSSC</option>
                                <option value="FSA">FSA</option>
                            </select>
                            @error('gestion')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="tipo_residuos" class="block text-sm font-medium text-gray-700">Tipos de Residuos</label>
                            <select name="tipo_residuos[]" id="tipo_residuos" multiple required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                @foreach($tiposResiduo as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                            <p class="text-sm text-gray-500 mt-1">Mantén presionada la tecla Ctrl (Windows) o Cmd (Mac) para seleccionar múltiples opciones.</p>
                            @error('tipo_residuos')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Proceder al pago') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir CSS y JS de Leaflet y Geocoder -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <!-- Script para inicializar el mapa -->
    <script>
        // Inicializar el mapa
        var map = L.map('map').setView([-33.4489, -70.6693], 13); // Configura la vista inicial

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(map);

        // Marcador para seleccionar ubicación
        var marker = L.marker([-33.4489, -70.6693], {
            draggable: true
        }).addTo(map);

        // Función para actualizar el campo de ubicación
        function updateLocation(lat, lng) {
            document.getElementById('ubicacion').value = lat + ',' + lng;
        }

        // Escuchar el evento 'dragend' del marcador
        marker.on('dragend', function(e) {
            var lat = e.target.getLatLng().lat.toFixed(6);
            var lng = e.target.getLatLng().lng.toFixed(6);
            updateLocation(lat, lng);
        });

        // Escuchar clics en el mapa para mover el marcador
        map.on('click', function(e) {
            marker.setLatLng(e.latlng); // Mueve el marcador a la posición del clic
            updateLocation(e.latlng.lat.toFixed(6), e.latlng.lng.toFixed(6)); // Actualiza el campo de ubicación
        });

        // Configuración del buscador
        var geocoder = L.Control.Geocoder.nominatim();

        // Buscador de direcciones
        document.getElementById('search').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Evita el comportamiento predeterminado de Enter
                geocoder.geocode(this.value, function(results) {
                    if (results.length > 0) {
                        var latLng = results[0].center;
                        marker.setLatLng(latLng); // Mueve el marcador a la nueva ubicación
                        map.setView(latLng, 13); // Centra el mapa en la nueva ubicación
                        updateLocation(latLng.lat.toFixed(6), latLng.lng.toFixed(6)); // Actualiza el campo de ubicación
                    } else {
                        alert('No se encontraron resultados');
                    }
                });
            }
        });
    </script>
</x-app-layout>
