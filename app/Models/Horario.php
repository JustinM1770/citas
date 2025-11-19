<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [
        'profesional_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'disponible',
    ];

    protected $casts = [
        'hora_inicio' => 'datetime:H:i',
        'hora_fin' => 'datetime:H:i',
        'disponible' => 'boolean',
    ];

    public function profesional()
    {
        return $this->belongsTo(Profesional::class);
    }
}
