<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
        'foto',
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class);
    }
}