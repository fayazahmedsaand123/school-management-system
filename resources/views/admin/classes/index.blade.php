@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Classes</h3>
        <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">+ Add Class</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Class Name</th>
                <th>Section</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($classes as $class)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $class->name }}</td>
                <td>{{ $class->section ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.classes.edit', $class->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.classes.destroy', $class->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this class?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center">No classes found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection