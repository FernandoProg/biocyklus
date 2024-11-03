<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'ubicacion',
        'miembros',
        'rrss',
        'compostan',
        'reciclan',
        'capacitarse',
        'asociacion',
        'user_id'
    ];

    public function tiposReciclajes()
    {
        return $this->belongsToMany(tipoReciclaje::class, 'organizacion_tipo_reciclajes');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'organizacion_user');
    }

    public function participantes()
    {
        return $this->belongsToMany(User::class, 'organizacion_user')
                ->whereHas('roles', function($query) {
                    $query->where('name', 'participante');
                });
    }
}
