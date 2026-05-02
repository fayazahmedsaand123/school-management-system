@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Notice Board</h3>
        <a href="{{ route('admin.notices.create') }}" class="btn btn-primary">+ Add Notice</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>For</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($notices as $notice)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $notice->title }}</td>
                <td>
                    @if($notice->for == 'all')
                        <span class="badge bg-primary">All</span>
                    @elseif($notice->for == 'teacher')
                        <span class="badge bg-info">Teacher</span>
                    @elseif($notice->for == 'student')
                        <span class="badge bg-success">Student</span>
                    @else
                        <span class="badge bg-warning text-dark">Parent</span>
                    @endif
                </td>
                <td>{{ $notice->created_at->format('d M Y') }}</td>
                <td>
                    <a href="{{ route('admin.notices.show', $notice->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('admin.notices.edit', $notice->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.notices.destroy', $notice->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this notice?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">No notices found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection