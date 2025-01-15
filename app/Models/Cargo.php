<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_cargo', 'descripcion_cargo'];

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'cargo_id');
    }
    
    public function miembros()
    {
        return $this->hasMany(Miembro::class);
    }

    public function profesor()
    {
        return $this->belongsTo(User::class, 'profesor_id');
    }


}