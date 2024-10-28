<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoResiduo;
use App\Models\Restaurante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class RestauranteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $direccionRestaurante = 'No disponible';
        $restaurante = Auth::user()->restaurantes()->first(); 
        
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
        $tiposResiduos = $restaurante ? $restaurante->tiposResiduos : [];
        return view('restaurante.index', compact('restaurante', 'direccionRestaurante', 'tiposResiduos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposResiduo = TipoResiduo::all();
        return view('restaurante.create', compact('tiposResiduo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'rubro' => 'required|in:lacteos,comida rapida,restauracion,alimentacion institucional,panificadora,carnica,pesquera,bebidas,otro',
            'telefono' => 'required|string|max:20',
            'ubicacion' => 'required|string', // Guardará el string de latitud,longitud
            'gestion' => 'required|in:BPM,HACCP,ISO,BRC,IFS food,BPA,FSSC,FSA',
            'tipo_residuos' => 'required|array',
            'tipo_residuos.*' => 'exists:tipo_residuos,id' // Asegura que cada tipo_residuo existe en la base de datos
        ]);

        // Crear el restaurante
        $restaurante = new Restaurante();
        $restaurante->nombre = $request->nombre;
        $restaurante->rubro = $request->rubro;
        $restaurante->telefono = $request->telefono;
        $restaurante->ubicacion = $request->ubicacion;
        $restaurante->gestion = $request->gestion;
        $restaurante->user_id = Auth::id();
        $restaurante->save();

        // Adjuntar los tipos de residuos seleccionados al restaurante
        $restaurante->tiposResiduos()->attach($request->tipo_residuos);

        // Redirigir con un mensaje de éxito
        return redirect()->route('restaurantes.index')->with('success', 'Restaurante creado exitosamente.');
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
        $restaurante = Restaurante::findOrFail($id);
        $tiposResiduos = TipoResiduo::all();
        return view('restaurante.edit', compact('restaurante', 'tiposResiduos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $restaurante = Restaurante::findOrFail($id);

        // Actualiza los campos del restaurante
        $restaurante->nombre = $request->input('nombre');
        $restaurante->rubro = $request->input('rubro');
        $restaurante->telefono = $request->input('telefono');
        $restaurante->gestion = $request->input('gestion');

        // Guarda los cambios
        $restaurante->save();

        // Actualiza la relación muchos a muchos
        $restaurante->tiposResiduos()->sync($request->input('tipos_residuo', [])); // Si no hay tipos seleccionados, se vaciará la relación

        return redirect()->route('restaurantes.index')->with('success', 'Restaurante actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $restaurante = Restaurante::findOrFail($id);
    
        // Eliminar el restaurante
        $restaurante->delete();

        // Redirigir a la vista con un mensaje de éxito
        return redirect()->route('restaurantes.index')->with('success', 'Restaurante eliminado exitosamente.');
    }
}
