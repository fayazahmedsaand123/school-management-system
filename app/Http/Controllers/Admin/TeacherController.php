<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')->latest()->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:100',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:6',
            'phone'         => 'nullable|string',
            'address'       => 'nullable|string',
            'qualification' => 'nullable|string',
            'photo'         => 'nullable|image|max:2048',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'teacher',
        ]);

        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('teachers', 'public');
        }

        Teacher::create([
            'user_id'       => $user->id,
            'phone'         => $request->phone,
            'address'       => $request->address,
            'qualification' => $request->qualification,
            'photo'         => $photo,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully!');
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'          => 'required|string|max:100',
            'phone'         => 'nullable|string',
            'address'       => 'nullable|string',
            'qualification' => 'nullable|string',
            'photo'         => 'nullable|image|max:2048',
        ]);

        $teacher->user->update(['name' => $request->name]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('teachers', 'public');
            $teacher->photo = $photo;
        }

        $teacher->update([
            'phone'         => $request->phone,
            'address'       => $request->address,
            'qualification' => $request->qualification,
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->user->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully!');
    }
}