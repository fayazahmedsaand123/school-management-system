@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Attendance Report</h3>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.attendance.report') }}" class="row g-3 mb-4">
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
    {{-- Summary --}}
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card text-white bg-success text-center p-3">
                <h5>Present</h5>
                <h3>{{ $attendances->where('status', 'present')->count() }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger text-center p-3">
                <h5>Absent</h5>
                <h3>{{ $attendances->where('status', 'absent')->count() }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning text-center p-3">
                <h5>Late</h5>
                <h3>{{ $attendances->where('status', 'late')->count() }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-primary text-center p-3">
                <h5>Total</h5>
                <h3>{{ $attendances->count() }}</h3>
            </div>
        </div>
    </div>

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
        <div class="alert alert-warning">No attendance records found for this date.</div>
    @endif
</div>
@endsection