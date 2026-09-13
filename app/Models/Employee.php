<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
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
    public function user() {
       return $this->belongsTo(User::class);
    }

    public function attendances() {
      return $this->hasMany(Attendance::class);
    }
}