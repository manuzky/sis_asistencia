<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    static $rules = [
        'fecha' => 'required',
        'miembro_id' => 'required',
    ];

    protected $perPage = 20;

    protected $fillable = ['fecha', 'miembro_id', 'updated_by'];

    public function miembro()
    {
        return $this->hasOne('App\Models\Miembro', 'id', 'miembro_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    use HasFactory;

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }

    // public function horario()
    // {
    //     return $this->belongsTo(Horario::class, 'horario_id');
    // }

    // // Relación con HorarioMateria (añadido)
    // public function horariosMaterias()
    // {
    //     return $this->hasManyThrough(
    //         HorarioMateria::class,  // Modelo de destino
    //         Horario::class,         // Modelo intermedio
    //         'asistencia_id',        // Clave foránea en la tabla de horarios
    //         'horario_id',           // Clave foránea en la tabla de horario_materia
    //         'id',                   // Clave primaria de la tabla asistencia
    //         'id'                    // Clave primaria de la tabla horario
    //     );
    // }
}
