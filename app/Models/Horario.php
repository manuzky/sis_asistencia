<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model {
    use HasFactory;

    // Asegura que solo estos campos puedan ser asignados masivamente
    protected $fillable = [
        'pnf_id', // PNF relacionado
        'trayecto', // Trayecto del PNF
        'semestre', // Semestre
        'turno', // Mañana, tarde, etc.
        'seccion', // Sección
        'dia',
        'hora',
        'materia_id',
        'profesor_id' // El miembro que da la clase
    ];

    // Relación con Materias
    public function materias() {
        return $this->belongsToMany(Materia::class, 'horario_materia', 'horario_id', 'materia_id')
            ->withPivot('dia', 'hora', 'profesor_id')
            ->withTimestamps();
    }

    // Relación con Miembros (profesores)
    public function profesor() {
        return $this->belongsTo(Miembro::class, 'profesor_id');
    }

    // Relación con PNF
    public function pnf() {
        return $this->belongsTo(PNF::class, 'pnf_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class);  // Relación con Materia
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);  // Relación con Cargo
    }

    public function asistencias()
{
    return $this->hasMany(Asistencia::class, 'horario_id');
}


}
