@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Add Student</h3>
    <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
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
            <label>Roll Number</label>
            <input type="text" name="roll_number" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control">
        </div>
        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection