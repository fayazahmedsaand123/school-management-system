@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Result Sheet</h3>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.marks.result') }}" class="row g-3 mb-4">
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
            <button class="btn btn-primary w-100">Generate Result</button>
        </div>
    </form>

    @if(count($marksData) > 0)
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student</th>
                    @foreach($subjects as $subject)
                        <th>{{ $subject->name }}</th>
                    @endforeach
                    <th>Total</th>
                    <th>Obtained</th>
                    <th>%</th>
                    <th>Grade</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($marksData as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data['student']->user->name }}</td>
                    @foreach($subjects as $subject)
                        <td>
                            {{ $data['marks'][$subject->id]->obtained_marks ?? '-' }}
                        </td>
                    @endforeach
                    <td>{{ $data['total'] }}</td>
                    <td>{{ $data['obtained'] }}</td>
                    <td>{{ $data['percentage'] }}%</td>
                    <td><span class="badge bg-primary">{{ $data['grade'] }}</span></td>
                    <td>
                        @if($data['percentage'] >= 50)
                            <span class="badge bg-success">Pass</span>
                        @else
                            <span class="badge bg-danger">Fail</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @elseif(request('class_id'))
        <div class="alert alert-warning">No result data found.</div>
    @endif
</div>
@endsection