<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Attendance;
use App\Models\Notice;
use App\Models\User;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalStudents  = Student::count();
        $totalTeachers  = Teacher::count();
        $totalClasses   = Classes::count();
        $totalSubjects  = Subject::count();
        $totalNotices   = Notice::count();
        $totalUsers     = User::count();

        $todayAttendance = Attendance::whereDate('date', today())->count();
        $presentToday    = Attendance::whereDate('date', today())
                            ->where('status', 'present')->count();
        $absentToday     = Attendance::whereDate('date', today())
                            ->where('status', 'absent')->count();

        $recentNotices   = Notice::latest()->take(5)->get();
        $recentStudents  = Student::with('user', 'class')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalStudents', 'totalTeachers', 'totalClasses',
            'totalSubjects', 'totalNotices', 'totalUsers',
            'todayAttendance', 'presentToday', 'absentToday',
            'recentNotices', 'recentStudents'
        ));
    }

    public function teacher()
    {
        return view('teacher.dashboard');
    }

    public function student()
    {
        return view('student.dashboard');
    }

    public function parent()
    {
        return view('parent.dashboard');
    }
}