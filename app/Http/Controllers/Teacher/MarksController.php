<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use App\Models\Teacher;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    public function index(Request $request)
    {
        $classes  = Classes::all();
        $marks    = collect();
        $subjects = collect();

        if ($request->class_id && $request->exam_type) {
            $subjects = Subject::where('class_id', $request->class_id)->get();
            $marks    = Mark::with('student.user', 'subject')
                ->whereHas('student', function ($q) use ($request) {
                    $q->where('class_id', $request->class_id);
                })
                ->where('exam_type', $request->exam_type)
                ->get();
        }

        return view('teacher.marks.index', compact(
            'classes', 'marks', 'subjects'
        ));
    }
}