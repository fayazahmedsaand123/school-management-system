<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Attendance;
use App\Models\Notice;

class DashboardController extends Controller
{
    public function index()
    {
        $teacher = Teacher::where('user_id', auth()->id())->first();

        $totalStudents  = 0;
        $totalSubjects  = 0;

        if ($teacher) {
            $totalSubjects = $teacher->subjects()->count();
        }

        $recentNotices = Notice::whereIn('for', ['all', 'teacher'])
            ->latest()->take(5)->get();

        return view('teacher.dashboard', compact(
            'teacher', 'totalSubjects', 'recentNotices'
        ));
    }
}