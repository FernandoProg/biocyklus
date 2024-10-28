<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoReciclaje extends Model
{
    use HasFactory;

    public function organizaciones()
    {
        return $this->belongsToMany(Organizacion::class, 'organizacion_tipo_reciclajes');
    }
}
