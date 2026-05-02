@extends('layouts.student')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>👋 Welcome, {{ auth()->user()->name }}</h3>
        <span class="text-muted">{{ now()->format('d M Y') }}</span>
    </div>

    @if($student)
    <div class="alert alert-info">
        Class: <strong>{{ $student->class->name ?? '-' }}</strong> |
        Roll No: <strong>{{ $student->roll_number }}</strong>
    </div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-success text-center p-3">
                <h6>Days Present</h6>
                <h2>{{ $totalPresent }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger text-center p-3">
                <h6>Days Absent</h6>
                <h2>{{ $totalAbsent }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-primary text-center p-3">
                <h6>Marks Records</h6>
                <h2>{{ $totalMarks }}</h2>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-dark text-white">
            <strong>📢 Recent Notices</strong>
        </div>
        <div class="card-body">
            @forelse($recentNotices as $notice)
            <div class="mb-3 border-bottom pb-2">
                <strong>{{ $notice->title }}</strong>
                <small class="text-muted float-end">{{ $notice->created_at->format('d M Y') }}</small>
                <p class="mb-0 text-muted small">{{ $notice->body }}</p>
            </div>
            @empty
                <p class="text-muted">No notices yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection