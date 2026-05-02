<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Notice;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::whereIn('for', ['all', 'teacher'])
            ->latest()->get();
        return view('teacher.notices.index', compact('notices'));
    }
}