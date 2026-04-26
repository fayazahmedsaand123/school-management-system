<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EnrollmentController extends Controller {

    // ========== List all enrollments ============ //
    public function index() {
        $enrollments = Enrollment::with(['student', 'course.teacher'])
            ->where('tenant_id', session('tenant_id'))
            ->latest()
            ->get();

        return Inertia::render('Enrollments/Index', [
            'enrollments' => $enrollments
        ]);
    }

    // ============ Show create form =============== //
    public function create() {
        $students = Student::where('tenant_id', session('tenant_id'))->get();
        $courses  = Course::with('teacher')
            ->where('tenant_id', session('tenant_id'))
            ->get();

        return Inertia::render('Enrollments/Create', [
            'students' => $students,
            'courses'  => $courses,
        ]);
    }

    // ============ Save new enrollment ================= //
    public function store(Request $request) {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id'  => 'required|exists:courses,id',
        ]);

        // ======== Check if already enrolled ========== //
        $exists = Enrollment::where('tenant_id', session('tenant_id'))
            ->where('student_id', $request->student_id)
            ->where('course_id', $request->course_id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['student_id' => 'This student is already enrolled in this course.']);
        }

        Enrollment::create([
            'tenant_id'  => session('tenant_id'),
            'student_id' => $request->student_id,
            'course_id'  => $request->course_id,
        ]);

        return redirect()->route('enrollments.index')->with('success', 'Student enrolled successfully!');
    }

    // =========== Delete enrollment ============== //
    public function destroy(Enrollment $enrollment) {
        $enrollment->delete();

        return redirect()->route('enrollments.index')->with('success', 'Enrollment removed successfully!');
    }
}