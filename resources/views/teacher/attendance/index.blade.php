@extends('layouts.teacher')
@section('content')
<div class="container mt-4">
    <h3>Attendance Records</h3>

    <form method="GET" action="{{ route('teacher.attendance.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label>Select Class</label>
            <select name="class_id" class="form-control" required>
                <option value="">-- Select Class --</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}"
                        {{ request('class_id') == $class->id ? 'selected' : '' }}>
                        {{ $class->name }} {{ $class->section }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label>Date</label>
            <input type="date" name="date" class="form-control" value="{{ $date }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button class="btn btn-primary w-100">Search</button>
        </div>
    </form>

    @if($attendances->count() > 0)
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $att)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $att->student->user->name ?? '-' }}</td>
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
            @endforeach
        </tbody>
    </table>
    @elseif(request('class_id'))
        <div class="alert alert-warning">No records found.</div>
    @endif
</div>
@endsection