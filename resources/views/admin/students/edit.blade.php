@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Edit Student</h3>
    <form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ $student->user->name }}" required>
        </div>
        <div class="mb-3">
            <label>Class</label>
            <select name="class_id" class="form-control" required>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>
                        {{ $class->name }} {{ $class->section }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $student->phone }}">
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control">{{ $student->address }}</textarea>
        </div>
        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control" value="{{ $student->date_of_birth }}">
        </div>
        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control">
            @if($student->photo)
                <img src="{{ asset('storage/'.$student->photo) }}" width="60" class="mt-2">
            @endif
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection