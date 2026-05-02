@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Add Marks</h3>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.marks.create') }}" class="row g-3 mb-4">
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
        <div class="col-md-4 d-flex align-items-end">
            <button class="btn btn-primary w-100">Load Students</button>
        </div>
    </form>

    @if($students->count() > 0)
    <form method="POST" action="{{ route('admin.marks.store') }}">
        @csrf
        <input type="hidden" name="class_id" value="{{ request('class_id') }}">

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <label>Subject</label>
                <select name="subject_id" class="form-control" required>
                    <option value="">-- Select Subject --</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label>Exam Type</label>
                <select name="exam_type" class="form-control" required>
                    <option value="">-- Select Exam --</option>
                    <option value="midterm">Midterm</option>
                    <option value="final">Final</option>
                    <option value="quiz">Quiz</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Total Marks</label>
                <input type="number" name="total_marks" class="form-control" required min="1">
            </div>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Roll No</th>
                    <th>Obtained Marks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student->roll_number }}</td>
                    <td>
                        <input type="number"
                            name="marks[{{ $student->id }}]"
                            class="form-control"
                            min="0"
                            required>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button class="btn btn-success">Save Marks</button>
        <a href="{{ route('admin.marks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
    @elseif(request('class_id'))
        <div class="alert alert-warning">No students found in this class.</div>
    @endif
</div>
@endsection