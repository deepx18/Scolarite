<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'apogee_number',
        'cne',
        'cin',
        'first_name',
        'last_name',
        'email',
        'date_of_birth',
        'birth_city',
        'nationality',
        'gender',
        'department',
        'study_level',
        'specialization',
        'bac_year',
        'province',
        'academic_track',
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
