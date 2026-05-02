@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Edit Notice</h3>
    <form action="{{ route('admin.notices.update', $notice->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $notice->title }}" required>
        </div>
        <div class="mb-3">
            <label>Notice For</label>
            <select name="for" class="form-control" required>
                <option value="all"     {{ $notice->for == 'all'     ? 'selected' : '' }}>All</option>
                <option value="teacher" {{ $notice->for == 'teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="student" {{ $notice->for == 'student' ? 'selected' : '' }}>Student</option>
                <option value="parent"  {{ $notice->for == 'parent'  ? 'selected' : '' }}>Parent</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Body</label>
            <textarea name="body" class="form-control" rows="5" required>{{ $notice->body }}</textarea>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.notices.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection