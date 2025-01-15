<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioMateria extends Model
{
    use HasFactory;

    protected $table = 'horario_materia';

    protected $fillable = [
        'horario_id', 'materia_id', 'profesor_id', 'dia', 'hora'
    ];

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'horario_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function profesor()
    {
        return $this->belongsTo(Miembro::class, 'profesor_id');
    }
}
