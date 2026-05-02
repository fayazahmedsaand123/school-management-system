<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Mark;
use App\Models\Notice;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())
            ->with('class')->first();

        $totalPresent = 0;
        $totalAbsent  = 0;
        $totalMarks   = 0;

        if ($student) {
            $totalPresent = Attendance::where('student_id', $student->id)
                ->where('status', 'present')->count();
            $totalAbsent  = Attendance::where('student_id', $student->id)
                ->where('status', 'absent')->count();
            $totalMarks   = Mark::where('student_id', $student->id)->count();
        }

        $recentNotices = Notice::whereIn('for', ['all', 'student'])
            ->latest()->take(5)->get();

        return view('student.dashboard', compact(
            'student', 'totalPresent', 'totalAbsent',
            'totalMarks', 'recentNotices'
        ));
    }
}