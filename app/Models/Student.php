<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'apogee_number',
        'cne',
        'date_of_birth',
        'department',
        'first_name',
        'last_name',
        'email',
        'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function requests()
    {
        return $this->hasMany(Request::class);
    }
}
