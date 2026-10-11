<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'phone', 'password', 'role', 'status'];

    protected $hidden = ['password', 'remember_token'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'dentist_id');
    }
}
