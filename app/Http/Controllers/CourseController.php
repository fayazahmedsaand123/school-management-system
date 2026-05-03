<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller {

    // ========= List all courses ============= //
    public function index() {
        $courses = Course::with('teacher')
            ->where('tenant_id', session('tenant_id'))
            ->latest()
            ->get();

        return Inertia::render('Courses/Index', [
            'courses' => $courses
        ]);
    }

    // ========== Show create form ============= //
    public function create() {
        $teachers = Teacher::where('tenant_id', session('tenant_id'))->get();

        return Inertia::render('Courses/Create', [
            'teachers' => $teachers
        ]);
    }

    // =========== Save new course ============= //
    public function store(Request $request) {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'teacher_id'  => 'required|exists:teachers,id',
        ]);

        Course::create([
            'tenant_id'   => session('tenant_id'),
            'teacher_id'  => $request->teacher_id,
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    // ========== Show edit form ============= //
    public function edit(Course $course) {
        $teachers = Teacher::where('tenant_id', session('tenant_id'))->get();

        return Inertia::render('Courses/Edit', [
            'course'   => $course,
            'teachers' => $teachers
        ]);
    }

    // =========== Update course ============= //
    public function update(Request $request, Course $course) {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'teacher_id'  => 'required|exists:teachers,id',
        ]);

        $course->update([
            'teacher_id'  => $request->teacher_id,
            'name'        => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    // ============ Delete course ============= //
    public function destroy(Course $course) {
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}