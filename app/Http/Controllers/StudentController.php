<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller {

    // ============ List all students ============= //
    public function index() {
        $students = Student::where('tenant_id', session('tenant_id'))->latest()->get();

        return Inertia::render('Students/Index', [
            'students' => $students
        ]);
    }

    // =========== Show create form =============== //
    public function create() {
        return Inertia::render('Students/Create');
    }

    // ========== Save new student =============== //
    public function store(Request $request) {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'nullable|string|max:20',
            'dob'   => 'nullable|date',
        ]);

        Student::create([
            'tenant_id' => session('tenant_id'),
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'dob'       => $request->dob,
        ]);

        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    // ========== Show edit form ============== //
    public function edit(Student $student) {
        return Inertia::render('Students/Edit', [
            'student' => $student
        ]);
    }

    // ============= Update student ============== //
    public function update(Request $request, Student $student) {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
            'dob'   => 'nullable|date',
        ]);

        $student->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob'   => $request->dob,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    // =========== Delete student ============== //
    public function destroy(Student $student) {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}