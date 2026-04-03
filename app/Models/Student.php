<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'apogee_number',
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
}
