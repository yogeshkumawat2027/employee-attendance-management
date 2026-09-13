<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController {

    public function index() {
        $employees = Employee::latest()->get();

        return view('employees.index', compact('employees'));
    }

    public function create() {
        return view('employees.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'employee_code' => 'required|string|max:50|unique:employees,employee_code',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:100',
            'designation' => 'nullable|string|max:100',
            'joining_date' => 'nullable|date',
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make('password123'),
                'role' => 'employee',
            ]);

            Employee::create([
                ...$validated,
                'user_id' => $user->id,
            ]);
        });

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee added successfully.');
    }

    public function edit(Employee $employee) {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee) {
        $validated = $request->validate([
            'employee_code' => 'required|string|max:50|unique:employees,employee_code,' . $employee->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email,' . $employee->id,
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|max:100',
            'designation' => 'nullable|string|max:100',
            'joining_date' => 'nullable|date',
        ]);

        $employee->update($validated);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee) {
        $employee->update([
            'is_active' => false,
        ]);

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deactivated successfully.');
    }
}