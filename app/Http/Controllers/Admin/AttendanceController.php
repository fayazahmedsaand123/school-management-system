<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Show attendance list
    public function index()
    {
        $attendances = Attendance::with('student.user', 'class')
            ->latest()
            ->get();
        return view('admin.attendance.index', compact('attendances'));
    }

    // Show take attendance form
    public function take(Request $request)
    {
        $classes  = Classes::all();
        $students = collect();
        $selectedClass = null;
        $date = $request->date ?? date('Y-m-d');

        if ($request->class_id) {
            $selectedClass = Classes::find($request->class_id);
            $students = Student::with('user')
                ->where('class_id', $request->class_id)
                ->get();
        }

        return view('admin.attendance.take', compact(
            'classes', 'students', 'selectedClass', 'date'
        ));
    }

    // Save attendance
    public function store(Request $request)
    {
        $request->validate([
            'class_id'  => 'required|exists:classes,id',
            'date'      => 'required|date',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $student_id => $status) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'class_id'  => $request->class_id,
                    'date'      => $request->date,
                ],
                ['status' => $status]
            );
        }

        return redirect()->route('admin.attendance.index')
            ->with('success', 'Attendance saved successfully!');
    }

    // Attendance report by class & date
    public function report(Request $request)
    {
        $classes     = Classes::all();
        $attendances = collect();
        $selectedClass = null;
        $date = $request->date ?? date('Y-m-d');

        if ($request->class_id) {
            $selectedClass = Classes::find($request->class_id);
            $attendances = Attendance::with('student.user')
                ->where('class_id', $request->class_id)
                ->where('date', $date)
                ->get();
        }

        return view('admin.attendance.report', compact(
            'classes', 'attendances', 'selectedClass', 'date'
        ));
    }
}