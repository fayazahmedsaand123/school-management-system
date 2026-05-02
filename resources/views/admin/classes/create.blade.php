@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Add Class</h3>
    <form action="{{ route('admin.classes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Class Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Section (optional)</label>
            <input type="text" name="section" class="form-control">
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection