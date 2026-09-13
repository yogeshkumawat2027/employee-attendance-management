<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model {

    protected $fillable = [
        'employee_id',
        'attendance_date',
        'login_time',
        'logout_time',
        'working_hours',
        'status',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'working_hours' => 'decimal:2',
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}