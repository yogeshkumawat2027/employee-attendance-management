<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_code',
        'name',
        'email',
        'phone',
        'department',
        'designation',
        'joining_date',
        'is_active',
    ];

    protected $casts = [
        'joining_date' => 'date',
        'is_active' => 'boolean',
    ];
}