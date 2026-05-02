@extends('layouts.teacher')
@section('content')
<div class="container mt-4">
    <h3>Marks Records</h3>

    <form method="GET" action="{{ route('teacher.marks.index') }}" class="row g-3 mb-4">
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
            <label>Exam Type</label>
            <select name="exam_type" class="form-control" required>
                <option value="">-- Select Exam --</option>
                <option value="midterm" {{ request('exam_type') == 'midterm' ? 'selected' : '' }}>Midterm</option>
                <option value="final"   {{ request('exam_type') == 'final'   ? 'selected' : '' }}>Final</option>
                <option value="quiz"    {{ request('exam_type') == 'quiz'    ? 'selected' : '' }}>Quiz</option>
            </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button class="btn btn-primary w-100">Search</button>
        </div>
    </form>

    @if($marks->count() > 0)
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Subject</th>
                <th>Total</th>
                <th>Obtained</th>
                <th>%</th>
            </tr>
        </thead>
        <tbody>
            @foreach($marks as $mark)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mark->student->user->name ?? '-' }}</td>
                <td>{{ $mark->subject->name ?? '-' }}</td>
                <td>{{ $mark->total_marks }}</td>
                <td>{{ $mark->obtained_marks }}</td>
                <td>
                    @php $pct = round(($mark->obtained_marks / $mark->total_marks) * 100, 2); @endphp
                    <span class="badge {{ $pct >= 50 ? 'bg-success' : 'bg-danger' }}">
                        {{ $pct }}%
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @elseif(request('class_id'))
        <div class="alert alert-warning">No marks found.</div>
    @endif
</div>
@endsection