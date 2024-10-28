<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organizacion;
use App\Models\TipoReciclaje;

class OrganizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('organizacion.index');
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
            'compostan' => 'required|boolean',
            'reciclan' => 'required|boolean',
            'capacitarse' => 'required|boolean',
            'asociacion' => 'required|string|in:agrupacion de hecho,asociacion,corporacion,fundacion,organizacion comunitaria,pyme o empresa,otro',
        ]);
    
        $organizacion = Organizacion::create([
            'nombre' => $validated['nombre'],
            'ubicacion' => $validated['ubicacion'],
            'miembros' => $validated['miembros'],
            'rrss' => $validated['rrss'] ?? null,
            'compostan' => $validated['compostan'],
            'reciclan' => $validated['reciclan'],
            'capacitarse' => $validated['capacitarse'],
            'asociacion' => $validated['asociacion'],
            'user_id' => auth()->id(),
        ]);
    
        // Guardar tipoReciclaje si reciclan es true
        if ($request->reciclan && $request->has('tipo_reciclaje')) {
            $organizacion->tiposReciclaje()->attach($request->tipo_reciclaje);
        }
    
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
