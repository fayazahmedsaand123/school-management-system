@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2>Welcome Parent — {{ auth()->user()->name }}</h2>
    <hr>
    <h5>📢 Notices</h5>
    @forelse(\App\Models\Notice::whereIn('for', ['all', 'parent'])->latest()->get() as $notice)
        <div class="alert alert-warning">
            <strong>{{ $notice->title }}</strong>
            <small class="float-end">{{ $notice->created_at->format('d M Y') }}</small>
            <p class="mb-0 mt-1">{{ $notice->body }}</p>
        </div>
    @empty
        <p>No notices.</p>
    @endforelse
</div>
@endsection