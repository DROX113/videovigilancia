<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camara extends Model
{
    protected $table = 'camaras';

    protected $fillable = [
        'nombre',
        'ubicacion',
        'ip',
        'estado',
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }
}