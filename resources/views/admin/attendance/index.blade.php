@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Attendance</h3>
        <div>
            <a href="{{ route('admin.attendance.take') }}" class="btn btn-primary">Take Attendance</a>
            <a href="{{ route('admin.attendance.report') }}" class="btn btn-info">View Report</a>
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
                <th>Class</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $att)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $att->student->user->name ?? '-' }}</td>
                <td>{{ $att->class->name ?? '-' }}</td>
                <td>{{ $att->date }}</td>
                <td>
                    @if($att->status == 'present')
                        <span class="badge bg-success">Present</span>
                    @elseif($att->status == 'absent')
                        <span class="badge bg-danger">Absent</span>
                    @else
                        <span class="badge bg-warning text-dark">Late</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">No attendance records found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection