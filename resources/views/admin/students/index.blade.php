@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Students</h3>
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">+ Add Student</a>
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
                <th>Roll No</th>
                <th>Class</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($student->photo)
                        <img src="{{ asset('storage/'.$student->photo) }}" width="50" height="50" style="border-radius:50%">
                    @else
                        <span>No Photo</span>
                    @endif
                </td>
                <td>{{ $student->user->name }}</td>
                <td>{{ $student->roll_number }}</td>
                <td>{{ $student->class->name ?? '-' }}</td>
                <td>{{ $student->phone ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this student?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">No students found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection