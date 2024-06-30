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

    protected $fillable = ['fecha','miembro_id'];


    public function miembro()
    {
        return $this->hasOne('App\Models\Miembro', 'id', 'miembro_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
