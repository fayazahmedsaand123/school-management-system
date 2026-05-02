@extends('layouts.teacher')
@section('content')
<div class="container mt-4">
    <h3>📢 Notices</h3>
    @forelse($notices as $notice)
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <strong>{{ $notice->title }}</strong>
            <small class="text-muted">{{ $notice->created_at->format('d M Y') }}</small>
        </div>
        <div class="card-body">
            <p class="mb-0">{{ $notice->body }}</p>
        </div>
    </div>
    @empty
        <div class="alert alert-info">No notices found.</div>
    @endforelse
</div>
@endsection