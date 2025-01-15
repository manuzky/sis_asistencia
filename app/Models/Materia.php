<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model {
    use HasFactory;

    protected $fillable = ['nombre', 'pnf_id'];

    // Especificamos el nombre de la tabla si es diferente a la convención
    protected $table = 'materias';  // Asegúrate de que el nombre de la tabla sea 'materias'

    // Relación con PNF
    public function pnf() {
        return $this->belongsTo(PNF::class, 'pnf_id');  // Relación inversa con PNF
    }

    // Relación con Horarios (muchos a muchos, ya que una materia puede estar en varios horarios)
    public function horarios() {
        return $this->belongsToMany(Horario::class, 'horario_materia', 'materia_id', 'horario_id')
            ->withPivot('dia', 'hora')
            ->withTimestamps();
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

}
