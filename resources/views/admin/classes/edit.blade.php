@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Edit Class</h3>
    <form action="{{ route('admin.classes.update', $class->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Class Name</label>
            <input type="text" name="name" class="form-control" value="{{ $class->name }}" required>
        </div>
        <div class="mb-3">
            <label>Section (optional)</label>
            <input type="text" name="section" class="form-control" value="{{ $class->section }}">
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection