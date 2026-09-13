<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up() {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnDelete();

            $table->date('attendance_date');

            $table->time('login_time')->nullable();
            $table->time('logout_time')->nullable();

            $table->decimal('working_hours', 5, 2)
                ->nullable();

            $table->enum('status', [
                'Present',
                'Absent',
                'Half Day',
                'Leave',
                'Holiday',
            ])->default('Absent');

            $table->timestamps();

            $table->unique([
                'employee_id',
                'attendance_date',
            ]);
        });
    }

    public function down() {
        Schema::dropIfExists('attendances');
    }
};