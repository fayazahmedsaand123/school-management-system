@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Add Subject</h3>
    <form action="{{ route('admin.subjects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Subject Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Class</label>
            <select name="class_id" class="form-control" required>
                <option value="">-- Select Class --</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }} {{ $class->section }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Teacher (optional)</label>
            <select name="teacher_id" class="form-control">
                <option value="">-- Select Teacher --</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->user->name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection