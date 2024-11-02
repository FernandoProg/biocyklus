<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Empleado extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'fNacimiento', 'cargo', 'restaurante_id'];

    protected $hidden = ['password', 'remember_token'];

    // Configura la encriptación de contraseñas
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class); // Relación de pertenece a
    }

    public function restaurantes()
    {
        return false;
    }

    public function organizacion()
    {
        return false;
    }

}
