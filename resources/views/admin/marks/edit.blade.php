@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Edit Mark</h3>
    <form action="{{ route('admin.marks.update', $mark->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Student</label>
            <input type="text" class="form-control"
                value="{{ $mark->student->user->name ?? '-' }}" disabled>
        </div>
        <div class="mb-3">
            <label>Subject</label>
            <input type="text" class="form-control"
                value="{{ $mark->subject->name ?? '-' }}" disabled>
        </div>
        <div class="mb-3">
            <label>Exam Type</label>
            <select name="exam_type" class="form-control" required>
                <option value="midterm" {{ $mark->exam_type == 'midterm' ? 'selected' : '' }}>Midterm</option>
                <option value="final"   {{ $mark->exam_type == 'final'   ? 'selected' : '' }}>Final</option>
                <option value="quiz"    {{ $mark->exam_type == 'quiz'    ? 'selected' : '' }}>Quiz</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Total Marks</label>
            <input type="number" name="total_marks"
                class="form-control" value="{{ $mark->total_marks }}" required min="1">
        </div>
        <div class="mb-3">
            <label>Obtained Marks</label>
            <input type="number" name="obtained_marks"
                class="form-control" value="{{ $mark->obtained_marks }}" required min="0">
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.marks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection