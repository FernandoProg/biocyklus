<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
{
    $user = auth()->user();
    $direccionRestaurante = null;
    
    if ($user->restaurantes) {
        $ubicacionRest = $user->restaurantes->ubicacion; // Latitud, longitud como 'lat,long'
        list($lat, $lng) = explode(',', $ubicacionRest);

        // Llamar a la API de Nominatim
        $responseRest = Http::get('https://nominatim.openstreetmap.org/reverse', [
            'lat' => $lat,
            'lon' => $lng,
            'format' => 'json',
        ]);

        if ($responseRest->successful()) {
            $direccionRestaurante = $responseRest->json()['display_name'];
        }
    }

    $direccionOrganizacion = null;
    
    if ($user->organizacion) {
        $ubicacionOrg = $user->organizacion->ubicacion; // Latitud, longitud como 'lat,long'
        list($lat, $lng) = explode(',', $ubicacionOrg);

        // Llamar a la API de Nominatim
        $responseOrg = Http::get('https://nominatim.openstreetmap.org/reverse', [
            'lat' => $lat,
            'lon' => $lng,
            'format' => 'json',
        ]);

        if ($responseOrg->successful()) {
            $direccionOrganizacion = $responseOrg->json()['display_name'];
        }
    }

    return view('dashboard', [
        'user' => $user,
        'direccionRestaurante' => $direccionRestaurante,
        'direccionOrganizacion' => $direccionOrganizacion,
    ]);
}
}
