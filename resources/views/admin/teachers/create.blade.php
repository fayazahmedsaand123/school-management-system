@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Add Teacher</h3>
    <form action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data">
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
            <label>Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Qualification</label>
            <input type="text" name="qualification" class="form-control">
        </div>
        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control">
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection