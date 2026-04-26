<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeacherController extends Controller {

    // ========= List all teachers ============= //
    public function index() {
        $teachers = Teacher::where('tenant_id', session('tenant_id'))->latest()->get();
        
        return Inertia::render('Teachers/Index', [
            'teachers' => $teachers
        ]);
    }

    // ========== Show create form ============== //
    public function create() {
        return Inertia::render('Teachers/Create');
    }

    // ============ Save new teacher ============== //
    public function store(Request $request) {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:teachers,email',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
        ]);

        Teacher::create([
            'tenant_id' => session('tenant_id'),
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'subject'   => $request->subject,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully!');
    }

    // ============ Show edit form ================ //
    public function edit(Teacher $teacher) {
        return Inertia::render('Teachers/Edit', [
            'teacher' => $teacher
        ]);
    }

    // ============= Update teacher ================ //
    public function update(Request $request, Teacher $teacher) {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone'   => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
        ]);

        $teacher->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'subject' => $request->subject,
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully!');
    }

    // =========== Delete teacher ============= //
    public function destroy(Teacher $teacher) {
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully!');
    }
}