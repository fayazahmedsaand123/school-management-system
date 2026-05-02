<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller {

    public function index() {
        $classes = Classes::latest()->get();
        return view('admin.classes.index', compact('classes'));
    }

    public function create() {
        return view('admin.classes.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name'    => 'required|string|max:100',
            'section' => 'nullable|string|max:10',
        ]);

        Classes::create($request->only('name', 'section'));

        return redirect()->route('admin.classes.index')->with('success', 'Class created successfully!');
    }

    public function edit(Classes $class) {
        return view('admin.classes.edit', compact('class'));
    }

    public function update(Request $request, Classes $class) {
        $request->validate([
            'name'    => 'required|string|max:100',
            'section' => 'nullable|string|max:10',
        ]);

        $class->update($request->only('name', 'section'));

        return redirect()->route('admin.classes.index')->with('success', 'Class updated successfully!');
    }

    public function destroy(Classes $class) {
        $class->delete();
        return redirect()->route('admin.classes.index')->with('success', 'Class deleted successfully!');
    }
}