@extends('layouts.student')
@section('content')
<div class="container mt-4">
    <h3>My Attendance</h3>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-success text-center p-3">
                <h6>Present</h6><h2>{{ $totalPresent }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger text-center p-3">
                <h6>Absent</h6><h2>{{ $totalAbsent }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning text-center p-3">
                <h6>Late</h6><h2>{{ $totalLate }}</h2>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $att)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $att->date }}</td>
                <td>
                    @if($att->status == 'present')
                        <span class="badge bg-success">Present</span>
                    @elseif($att->status == 'absent')
                        <span class="badge bg-danger">Absent</span>
                    @else
                        <span class="badge bg-warning text-dark">Late</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center">No records found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection