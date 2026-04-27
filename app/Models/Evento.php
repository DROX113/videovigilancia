<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = [
        'camara_id',
        'usuario_id',
        'tipo',
        'descripcion',
        'fecha_hora',
    ];

    public function camara()
    {
        return $this->belongsTo(Camara::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class);
    }
}