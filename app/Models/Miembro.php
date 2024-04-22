<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}