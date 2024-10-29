<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organizacion;
use App\Models\TipoReciclaje;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrganizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $organizacion = Auth::user()->organizacion()->first(); 
        $direccionOrganizacion = 'No disponible';
        $tiposReciclaje = $organizacion ? $organizacion->tiposReciclajes : collect();
        if ($user->organizacion) {
            $ubicacion = $user->organizacion->ubicacion; // Latitud, longitud como 'lat,long'
            list($lat, $lng) = explode(',', $ubicacion);

            // Llamar a la API de Nominatim
            $response = Http::get('https://nominatim.openstreetmap.org/reverse', [
                'lat' => $lat,
                'lon' => $lng,
                'format' => 'json',
            ]);
            if ($response->successful()) {
                $direccionOrganizacion = $response->json()['display_name'];
            }
        }
        return view('organizacion.index', compact('organizacion', 'tiposReciclaje', 'direccionOrganizacion'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposReciclaje = TipoReciclaje::all();
        return view('organizacion.create', compact('tiposReciclaje'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string',
            'miembros' => 'required|integer',
            'rrss' => 'nullable|string',
            'asociacion' => 'required|string|in:agrupacion de hecho,asociacion,corporacion,fundacion,organizacion comunitaria,pyme o empresa,otro',
        ]);
    
        $organizacion = Organizacion::create([
            'nombre' => $request->nombre,
            'ubicacion' => $request->ubicacion,
            'miembros' => $request->miembros,
            'rrss' => $request->rrss,
            'compostan' => $request->has('compostan'),
            'reciclan' => $request->has('reciclan'),
            'capacitarse' => $request->has('capacitarse'),
            'asociacion' => $request->asociacion,
            'user_id' => auth()->id(),
        ]);
    
        // Guardar tipoReciclaje si reciclan es true
        if ($request->has('reciclan') && $request->has('tipo_reciclaje')) {
            $organizacion->tiposReciclajes()->sync($request->tipo_reciclaje);
        }
        // return response()->json($organizacion);
    
        return redirect()->route('organizacion.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $organizacion = Organizacion::findOrFail($id);
        $tiposReciclaje = TipoReciclaje::all();
        return view('organizacion.edit', compact('organizacion', 'tiposReciclaje'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ubicacion' => 'required|string',
            'miembros' => 'required|integer|min:1',
            'rrss' => 'required|string|max:255',
            'asociacion' => 'required|string|max:255',
            'tipo_reciclaje' => 'array',
        ]);

        // Encontrar la organización por su ID
        $organizacion = Organizacion::findOrFail($id);

        // Actualización de los atributos principales
        $organizacion->nombre = $request->nombre;
        $organizacion->ubicacion = $request->ubicacion;
        $organizacion->miembros = $request->miembros;
        $organizacion->rrss = $request->rrss;
        $organizacion->compostan = $request->has('compostan');
        $organizacion->reciclan = $request->has('reciclan');
        $organizacion->capacitarse = $request->has('capacitarse');
        $organizacion->asociacion = $request->asociacion;

        // Guardar los cambios de la organización
        $organizacion->save();

        // Actualizar tipos de reciclaje solo si reciclan
        if ($request->has('reciclan')) {
            $organizacion->tiposReciclajes()->sync($request->tipo_reciclaje ?? []);
        } else {
            // Eliminar relaciones de reciclaje si no reciclan
            $organizacion->tiposReciclajes()->detach();
        }

        // Redireccionar con un mensaje de éxito
        return redirect()->route('organizacion.index')->with('success', 'Organización actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $organizacion = Organizacion::findOrFail($id);
        $organizacion->delete();
        return redirect()->route('organizacion.index')->with('success', 'Organizacion eliminada exitosamente.');
    }
}
