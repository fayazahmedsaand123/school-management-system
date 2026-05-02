@extends('layouts.admin')
@section('content')
<div class="container mt-4">

    {{-- Welcome --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>👋 Welcome, {{ auth()->user()->name }}</h3>
        <span class="text-muted">{{ now()->format('d M Y') }}</span>
    </div>

    {{-- Stats Cards Row 1 --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary text-center p-3">
                <h6>Total Students</h6>
                <h2>{{ $totalStudents }}</h2>
                <a href="{{ route('admin.students.index') }}" class="text-white">View All </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success text-center p-3">
                <h6>Total Teachers</h6>
                <h2>{{ $totalTeachers }}</h2>
                <a href="{{ route('admin.teachers.index') }}" class="text-white">View All →</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info text-center p-3">
                <h6>Total Classes</h6>
                <h2>{{ $totalClasses }}</h2>
                <a href="{{ route('admin.classes.index') }}" class="text-white">View All →</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning text-center p-3">
                <h6>Total Subjects</h6>
                <h2>{{ $totalSubjects }}</h2>
                <a href="{{ route('admin.subjects.index') }}" class="text-white">View All →</a>
            </div>
        </div>
    </div>

    {{-- Stats Cards Row 2 --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-secondary text-center p-3">
                <h6>Today Attendance</h6>
                <h2>{{ $todayAttendance }}</h2>
                <a href="{{ route('admin.attendance.index') }}" class="text-white">View →</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success text-center p-3">
                <h6>Present Today</h6>
                <h2>{{ $presentToday }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger text-center p-3">
                <h6>Absent Today</h6>
                <h2>{{ $absentToday }}</h2>
            </div>
        </div>
    </div>

    {{-- Recent Students & Notices --}}
    <div class="row g-3">

        {{-- Recent Students --}}
        <div class="col-md-7">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <strong>Recent Students</strong>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Roll No</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentStudents as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->user->name ?? '-' }}</td>
                                <td>{{ $student->class->name ?? '-' }}</td>
                                <td>{{ $student->roll_number }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No students yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Recent Notices --}}
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <strong>Recent Notices</strong>
                </div>
                <div class="card-body">
                    @forelse($recentNotices as $notice)
                    <div class="mb-3 border-bottom pb-2">
                        <strong>{{ $notice->title }}</strong>
                        <span class="badge
                            {{ $notice->for == 'all'     ? 'bg-primary'  : '' }}
                            {{ $notice->for == 'teacher' ? 'bg-info'     : '' }}
                            {{ $notice->for == 'student' ? 'bg-success'  : '' }}
                            {{ $notice->for == 'parent'  ? 'bg-warning text-dark'  : '' }}
                            ms-1">
                            {{ ucfirst($notice->for) }}
                        </span>
                        <p class="mb-0 text-muted small">
                            {{ Str::limit($notice->body, 60) }}
                        </p>
                        <small class="text-muted">
                            {{ $notice->created_at->format('d M Y') }}
                        </small>
                    </div>
                    @empty
                        <p class="text-muted">No notices yet.</p>
                    @endforelse
                    <a href="{{ route('admin.notices.index') }}" class="btn btn-sm btn-primary w-100">
                        View All Notices
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- Quick Links --}}
    <div class="row g-3 mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <strong>Quick Links</strong>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.students.create') }}" class="btn btn-primary me-2">+ Add Student</a>
                    <a href="{{ route('admin.teachers.create') }}" class="btn btn-success me-2">+ Add Teacher</a>
                    <a href="{{ route('admin.classes.create') }}"  class="btn btn-info me-2">+ Add Class</a>
                    <a href="{{ route('admin.subjects.create') }}" class="btn btn-warning me-2">+ Add Subject</a>
                    <a href="{{ route('admin.attendance.take') }}" class="btn btn-secondary me-2">Take Attendance</a>
                    <a href="{{ route('admin.marks.create') }}"    class="btn btn-danger me-2">+ Add Marks</a>
                    <a href="{{ route('admin.notices.create') }}"  class="btn btn-dark me-2">+ Add Notice</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection