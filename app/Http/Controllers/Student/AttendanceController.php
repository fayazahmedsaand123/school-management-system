<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->first();

        $attendances = collect();
        $totalPresent = 0;
        $totalAbsent  = 0;
        $totalLate    = 0;

        if ($student) {
            $attendances  = Attendance::where('student_id', $student->id)
                ->latest()->get();
            $totalPresent = $attendances->where('status', 'present')->count();
            $totalAbsent  = $attendances->where('status', 'absent')->count();
            $totalLate    = $attendances->where('status', 'late')->count();
        }

        return view('student.attendance.index', compact(
            'attendances', 'totalPresent', 'totalAbsent', 'totalLate'
        ));
    }
}