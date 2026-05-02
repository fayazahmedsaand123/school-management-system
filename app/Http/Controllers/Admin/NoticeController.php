<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller {

    public function index() {
        $notices = Notice::latest()->get();
        return view('admin.notices.index', compact('notices'));
    }

    public function create() {
        return view('admin.notices.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:200',
            'body'  => 'required|string',
            'for'   => 'required|in:all,teacher,student,parent',
        ]);

        Notice::create($request->only('title', 'body', 'for'));

        return redirect()->route('admin.notices.index')
            ->with('success', 'Notice created successfully!');
    }

    public function edit(Notice $notice) {
        return view('admin.notices.edit', compact('notice'));
    }

    public function update(Request $request, Notice $notice) {
        $request->validate([
            'title' => 'required|string|max:200',
            'body'  => 'required|string',
            'for'   => 'required|in:all,teacher,student,parent',
        ]);

        $notice->update($request->only('title', 'body', 'for'));

        return redirect()->route('admin.notices.index')
            ->with('success', 'Notice updated successfully!');
    }

    public function destroy(Notice $notice) {
        $notice->delete();
        return redirect()->route('admin.notices.index')
            ->with('success', 'Notice deleted successfully!');
    }

    public function show(Notice $notice) {
        return view('admin.notices.show', compact('notice'));
    }
}