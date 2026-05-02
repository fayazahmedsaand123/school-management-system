@extends('layouts.student')
@section('content')
<div class="container mt-4">
    <h3>My Marks</h3>

    <form method="GET" action="{{ route('student.marks.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <label>Exam Type</label>
            <select name="exam_type" class="form-control">
                <option value="">-- All Exams --</option>
                <option value="midterm" {{ request('exam_type') == 'midterm' ? 'selected' : '' }}>Midterm</option>
                <option value="final"   {{ request('exam_type') == 'final'   ? 'selected' : '' }}>Final</option>
                <option value="quiz"    {{ request('exam_type') == 'quiz'    ? 'selected' : '' }}>Quiz</option>
            </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
    </form>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Subject</th>
                <th>Exam</th>
                <th>Total</th>
                <th>Obtained</th>
                <th>%</th>
                <th>Grade</th>
            </tr>
        </thead>
        <tbody>
            @forelse($marks as $mark)
            @php
                $pct   = round(($mark->obtained_marks / $mark->total_marks) * 100, 2);
                $grade = $pct >= 90 ? 'A+' : ($pct >= 80 ? 'A' : ($pct >= 70 ? 'B' :
                         ($pct >= 60 ? 'C' : ($pct >= 50 ? 'D' : 'F'))));
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mark->subject->name ?? '-' }}</td>
                <td>{{ ucfirst($mark->exam_type) }}</td>
                <td>{{ $mark->total_marks }}</td>
                <td>{{ $mark->obtained_marks }}</td>
                <td>
                    <span class="badge {{ $pct >= 50 ? 'bg-success' : 'bg-danger' }}">
                        {{ $pct }}%
                    </span>
                </td>
                <td><span class="badge bg-primary">{{ $grade }}</span></td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">No marks found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection