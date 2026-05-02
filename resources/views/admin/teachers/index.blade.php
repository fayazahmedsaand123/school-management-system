@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Teachers</h3>
        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">+ Add Teacher</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Qualification</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teachers as $teacher)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($teacher->photo)
                        <img src="{{ asset('storage/'.$teacher->photo) }}" width="50" height="50" style="border-radius:50%">
                    @else
                        <span>No Photo</span>
                    @endif
                </td>
                <td>{{ $teacher->user->name }}</td>
                <td>{{ $teacher->user->email }}</td>
                <td>{{ $teacher->phone ?? '-' }}</td>
                <td>{{ $teacher->qualification ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this teacher?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">No teachers found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection