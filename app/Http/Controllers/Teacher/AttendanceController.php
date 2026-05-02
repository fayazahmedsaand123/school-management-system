<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $teacher  = Teacher::where('user_id', auth()->id())->first();
        $classes  = Classes::all();
        $attendances = collect();
        $date = $request->date ?? date('Y-m-d');

        if ($request->class_id) {
            $attendances = Attendance::with('student.user')
                ->where('class_id', $request->class_id)
                ->where('date', $date)
                ->get();
        }

        return view('teacher.attendance.index', compact(
            'classes', 'attendances', 'date'
        ));
    }
}