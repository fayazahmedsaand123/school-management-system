@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Marks</h3>
        <div>
            <a href="{{ route('admin.marks.create') }}" class="btn btn-primary">+ Add Marks</a>
            <a href="{{ route('admin.marks.result') }}" class="btn btn-info">View Result</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Subject</th>
                <th>Exam Type</th>
                <th>Total</th>
                <th>Obtained</th>
                <th>Percentage</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($marks as $mark)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mark->student->user->name ?? '-' }}</td>
                <td>{{ $mark->subject->name ?? '-' }}</td>
                <td>{{ ucfirst($mark->exam_type) }}</td>
                <td>{{ $mark->total_marks }}</td>
                <td>{{ $mark->obtained_marks }}</td>
                <td>
                    @php
                        $pct = round(($mark->obtained_marks / $mark->total_marks) * 100, 2);
                    @endphp
                    <span class="badge {{ $pct >= 50 ? 'bg-success' : 'bg-danger' }}">
                        {{ $pct }}%
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.marks.edit', $mark->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.marks.destroy', $mark->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this mark?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">No marks found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection