@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Subjects</h3>
        <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary">+ Add Subject</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Class</th>
                <th>Teacher</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subjects as $subject)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $subject->name }}</td>
                <td>{{ $subject->class->name ?? '-' }}</td>
                <td>{{ $subject->teacher->user->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.subjects.edit', $subject->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this subject?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">No subjects found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection