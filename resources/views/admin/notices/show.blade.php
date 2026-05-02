@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">{{ $notice->title }}</h4>
            @if($notice->for == 'all')
                <span class="badge bg-primary">All</span>
            @elseif($notice->for == 'teacher')
                <span class="badge bg-info">Teacher</span>
            @elseif($notice->for == 'student')
                <span class="badge bg-success">Student</span>
            @else
                <span class="badge bg-warning text-dark">Parent</span>
            @endif
        </div>
        <div class="card-body">
            <p class="text-muted">{{ $notice->created_at->format('d M Y') }}</p>
            <p>{{ $notice->body }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.notices.edit', $notice->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.notices.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection