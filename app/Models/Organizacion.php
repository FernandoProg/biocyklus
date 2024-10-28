<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizacion extends Model
{
    use HasFactory;

    public function tiposReciclajes()
    {
        return $this->belongsToMany(tipoReciclaje::class, 'restaurante_tipo_reciclajes');
    }
}
