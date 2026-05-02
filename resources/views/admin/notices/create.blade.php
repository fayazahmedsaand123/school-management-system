@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Add Notice</h3>
    <form action="{{ route('admin.notices.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Notice For</label>
            <select name="for" class="form-control" required>
                <option value="all">All</option>
                <option value="teacher">Teacher</option>
                <option value="student">Student</option>
                <option value="parent">Parent</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Body</label>
            <textarea name="body" class="form-control" rows="5" required></textarea>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('admin.notices.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection