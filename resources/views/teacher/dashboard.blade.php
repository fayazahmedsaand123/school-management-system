@extends('layouts.teacher')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>👋 Welcome, {{ auth()->user()->name }}</h3>
        <span class="text-muted">{{ now()->format('d M Y') }}</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card text-white bg-success text-center p-3">
                <h6>My Subjects</h6>
                <h2>{{ $totalSubjects }}</h2>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-info text-center p-3">
                <h6>Notices</h6>
                <h2>{{ $recentNotices->count() }}</h2>
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