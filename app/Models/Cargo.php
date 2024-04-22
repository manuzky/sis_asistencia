<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    public function miembros()
    {
        return $this->hasMany(Miembro::class);
    }
}