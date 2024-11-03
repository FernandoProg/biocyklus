<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $direccionRestaurante = null;
        $restaurante = $user->restaurantes()->first();
        if ($restaurante) {
            $ubicacionRest = $restaurante->ubicacion; // Cambiado para acceder al primer restaurante
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
    
        $organizacion = Auth::user()->organizaciones()->first();
        $direccionOrganizacion = null;
        if ($organizacion) {
            $ubicacionOrg = $organizacion->ubicacion; // Latitud, longitud como 'lat,long'
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
