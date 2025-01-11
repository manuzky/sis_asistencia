<?php

// app/Models/PNF.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PNF extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    // Especificamos el nombre de la tabla si es diferente a la convención
    protected $table = 'pnfs';  // Asegúrate de que el nombre de la tabla sea 'pnfs'

    public function materias()
    {
        return $this->hasMany(Materia::class, 'pnf_id');  // Relación con la tabla 'materias'
    }
}
