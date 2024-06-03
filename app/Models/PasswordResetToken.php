<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'token',
        'created_at',
        'password_reset_id'
    ];

    public function passwordReset()
    {
        return $this->belongsTo(PasswordReset::class);
    }
}
