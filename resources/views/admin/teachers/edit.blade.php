@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Edit Teacher</h3>
    <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ $teacher->user->name }}" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $teacher->phone }}">
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control">{{ $teacher->address }}</textarea>
        </div>
        <div class="mb-3">
            <label>Qualification</label>
            <input type="text" name="qualification" class="form-control" value="{{ $teacher->qualification }}">
        </div>
        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control">
            @if($teacher->photo)
                <img src="{{ asset('storage/'.$teacher->photo) }}" width="60" class="mt-2">
            @endif
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection