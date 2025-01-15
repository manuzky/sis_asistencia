<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
    use HasFactory;

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    // Relación con Horarios (el profesor tiene varios horarios asignados)
    public function horarios()
    {
        return $this->hasMany(Horario::class, 'profesor_id');
    }

    public function miembro()
{
    return $this->belongsTo(Miembro::class);
}

}