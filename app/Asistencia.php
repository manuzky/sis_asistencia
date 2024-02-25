<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Asistencia extends Model
{
    
    static $rules = [
		'fecha' => 'required',
		'miembro_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','miembro_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function miembro()
    {
        return $this->hasOne('App\Models\Miembro', 'id', 'miembro_id');
    }
    

}
