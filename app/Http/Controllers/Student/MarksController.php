<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Mark;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    public function index(Request $request)
    {
        $student = Student::where('user_id', auth()->id())->first();

        $marks = collect();

        if ($student) {
            $query = Mark::with('subject')
                ->where('student_id', $student->id);

            if ($request->exam_type) {
                $query->where('exam_type', $request->exam_type);
            }

            $marks = $query->get();
        }

        return view('student.marks.index', compact('marks'));
    }
}