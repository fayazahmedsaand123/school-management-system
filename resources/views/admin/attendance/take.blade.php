@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Take Attendance</h3>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.attendance.take') }}" class="row g-3 mb-4">
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
            <button class="btn btn-primary w-100">Load Students</button>
        </div>
    </form>

    {{-- Attendance Form --}}
    @if($students->count() > 0)
    <form method="POST" action="{{ route('admin.attendance.store') }}">
        @csrf
        <input type="hidden" name="class_id" value="{{ request('class_id') }}">
        <input type="hidden" name="date" value="{{ $date }}">

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Roll No</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>Late</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student->roll_number }}</td>
                    <td>
                        <input type="radio"
                            name="attendance[{{ $student->id }}]"
                            value="present" checked>
                    </td>
                    <td>
                        <input type="radio"
                            name="attendance[{{ $student->id }}]"
                            value="absent">
                    </td>
                    <td>
                        <input type="radio"
                            name="attendance[{{ $student->id }}]"
                            value="late">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn btn-success">Save Attendance</button>
        <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
    @elseif(request('class_id'))
        <div class="alert alert-warning">No students found in this class.</div>
    @endif
</div>
@endsection