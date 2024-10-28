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
        $ubicacion = $user->restaurantes->ubicacion; // Latitud, longitud como 'lat,long'
        list($lat, $lng) = explode(',', $ubicacion);

        // Llamar a la API de Nominatim
        $response = Http::get('https://nominatim.openstreetmap.org/reverse', [
            'lat' => $lat,
            'lon' => $lng,
            'format' => 'json',
        ]);

        if ($response->successful()) {
            $direccionRestaurante = $response->json()['display_name'];
        }
    }

    return view('dashboard', [
        'user' => $user,
        'direccionRestaurante' => $direccionRestaurante,
    ]);
}
}
