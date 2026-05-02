<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Classes;
use Illuminate\Http\Request;

class MarksController extends Controller {

    // Show all marks
    public function index() {
        $marks = Mark::with('student.user', 'subject')->latest()->get();
        return view('admin.marks.index', compact('marks'));
    }

    // Show add marks form
    public function create(Request $request) {
        $classes  = Classes::all();
        $students = collect();
        $subjects = collect();

        if ($request->class_id) {
            $students = Student::with('user')
                ->where('class_id', $request->class_id)
                ->get();
            $subjects = Subject::where('class_id', $request->class_id)->get();
        }

        return view('admin.marks.create', compact('classes', 'students', 'subjects'));
    }

    // Save marks
    public function store(Request $request) {
        $request->validate([
            'class_id'       => 'required|exists:classes,id',
            'subject_id'     => 'required|exists:subjects,id',
            'exam_type'      => 'required|string',
            'total_marks'    => 'required|integer|min:1',
            'marks'          => 'required|array',
            'marks.*'        => 'required|integer|min:0',
        ]);

        foreach ($request->marks as $student_id => $obtained) {
            Mark::updateOrCreate(
                [
                    'student_id' => $student_id,
                    'subject_id' => $request->subject_id,
                    'exam_type'  => $request->exam_type,
                ],
                [
                    'total_marks'    => $request->total_marks,
                    'obtained_marks' => $obtained,
                ]
            );
        }

        return redirect()->route('admin.marks.index')
            ->with('success', 'Marks saved successfully!');
    }

    // Edit single mark
    public function edit(Mark $mark) {
        $subjects = Subject::all();
        $students = Student::with('user')->get();
        return view('admin.marks.edit', compact('mark', 'subjects', 'students'));
    }

    // Update single mark
    public function update(Request $request, Mark $mark) {
        $request->validate([
            'total_marks'    => 'required|integer|min:1',
            'obtained_marks' => 'required|integer|min:0',
            'exam_type'      => 'required|string',
        ]);

        $mark->update($request->only(
            'total_marks', 'obtained_marks', 'exam_type'
        ));

        return redirect()->route('admin.marks.index')
            ->with('success', 'Mark updated successfully!');
    }

    // Delete mark
    public function destroy(Mark $mark) {
        $mark->delete();
        return redirect()->route('admin.marks.index')
            ->with('success', 'Mark deleted successfully!');
    }

    // Result sheet by class & exam type
    public function result(Request $request) {
        $classes   = Classes::all();
        $students  = collect();
        $subjects  = collect();
        $marksData = collect();
        $date      = $request->date ?? date('Y-m-d');

        if ($request->class_id && $request->exam_type) {
            $students = Student::with('user')
                ->where('class_id', $request->class_id)
                ->get();
            $subjects = Subject::where('class_id', $request->class_id)->get();

            foreach ($students as $student) {
                $studentMarks = [];
                $total        = 0;
                $obtained     = 0;

                foreach ($subjects as $subject) {
                    $mark = Mark::where('student_id', $student->id)
                        ->where('subject_id', $subject->id)
                        ->where('exam_type', $request->exam_type)
                        ->first();

                    $studentMarks[$subject->id] = $mark;
                    $total   += $mark ? $mark->total_marks : 0;
                    $obtained += $mark ? $mark->obtained_marks : 0;
                }

                $percentage = $total > 0 ? round(($obtained / $total) * 100, 2) : 0;
                $grade      = $this->getGrade($percentage);

                $marksData[] = [
                    'student'     => $student,
                    'marks'       => $studentMarks,
                    'total'       => $total,
                    'obtained'    => $obtained,
                    'percentage'  => $percentage,
                    'grade'       => $grade,
                ];
            }
        }

        return view('admin.marks.result', compact(
            'classes', 'students', 'subjects', 'marksData'
        ));
    }

    // Grade logic
    private function getGrade($percentage) {
        if ($percentage >= 90) return 'A+';
        if ($percentage >= 80) return 'A';
        if ($percentage >= 70) return 'B';
        if ($percentage >= 60) return 'C';
        if ($percentage >= 50) return 'D';
        return 'F';
    }
}