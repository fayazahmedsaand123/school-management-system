<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user', 'class')->latest()->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classes = Classes::all();
        return view('admin.students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:100',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:6',
            'class_id'      => 'required|exists:classes,id',
            'roll_number'   => 'required|unique:students',
            'phone'         => 'nullable|string',
            'address'       => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'photo'         => 'nullable|image|max:2048',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'student',
        ]);

        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('students', 'public');
        }

        Student::create([
            'user_id'       => $user->id,
            'class_id'      => $request->class_id,
            'roll_number'   => $request->roll_number,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'photo'         => $photo,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student added successfully!');
    }

    public function edit(Student $student)
    {
        $classes = Classes::all();
        return view('admin.students.edit', compact('student', 'classes'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'          => 'required|string|max:100',
            'class_id'      => 'required|exists:classes,id',
            'phone'         => 'nullable|string',
            'address'       => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'photo'         => 'nullable|image|max:2048',
        ]);

        $student->user->update(['name' => $request->name]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('students', 'public');
            $student->photo = $photo;
        }

        $student->update([
            'class_id'      => $request->class_id,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'date_of_birth' => $request->date_of_birth,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->user->delete();
        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully!');
    }
}