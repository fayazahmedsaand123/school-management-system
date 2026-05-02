<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller {

    public function index() {
        $subjects = Subject::with('class', 'teacher')->latest()->get();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create() {
        $classes  = Classes::all();
        $teachers = Teacher::with('user')->get();
        return view('admin.subjects.create', compact('classes', 'teachers'));
    }

    public function store(Request $request) {
        $request->validate([
            'name'       => 'required|string|max:100',
            'class_id'   => 'required|exists:classes,id',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        Subject::create($request->only('name', 'class_id', 'teacher_id'));

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully!');
    }

    public function edit(Subject $subject) {
        $classes  = Classes::all();
        $teachers = Teacher::with('user')->get();
        return view('admin.subjects.edit', compact('subject', 'classes', 'teachers'));
    }

    public function update(Request $request, Subject $subject) {
        $request->validate([
            'name'       => 'required|string|max:100',
            'class_id'   => 'required|exists:classes,id',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        $subject->update($request->only('name', 'class_id', 'teacher_id'));

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully!');
    }

    public function destroy(Subject $subject) {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted successfully!');
    }
}