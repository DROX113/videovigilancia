<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $table = 'alertas';

    protected $fillable = [
        'evento_id',
        'usuario_id',
        'nivel',
        'estado',
        'mensaje',
    ];

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}