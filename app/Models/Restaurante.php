<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre', 'rubro', 'telefono', 'ubicacion', 'gestion', 'user_id'
    ];

    public function tiposResiduos()
    {
        return $this->belongsToMany(tipoResiduo::class, 'restaurante_tipo_residuos');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'restaurante_user');
    }

    public function empleados()
    {
        return $this->belongsToMany(User::class, 'restaurante_user')
                ->whereHas('roles', function($query) {
                    $query->where('name', 'empleado'); // Filtrar por el rol 'empleado'
                });
    }
}
