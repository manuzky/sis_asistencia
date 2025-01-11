<?php

// app/Models/Materia.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'pnf_id'];

    // Especificamos el nombre de la tabla si es diferente a la convención
    protected $table = 'materias';  // Asegúrate de que el nombre de la tabla sea 'materias'

    public function pnf()
    {
        return $this->belongsTo(PNF::class, 'pnf_id');  // Relación inversa con PNF
    }
}
