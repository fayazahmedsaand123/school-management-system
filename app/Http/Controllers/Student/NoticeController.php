<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::whereIn('for', ['all', 'student'])
            ->latest()->get();
        return view('student.notices.index', compact('notices'));
    }
}