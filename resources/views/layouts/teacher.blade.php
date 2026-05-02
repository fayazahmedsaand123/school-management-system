<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Panel — School MS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { min-height: 100vh; background: #f4f6f9; }
        #sidebar {
            width: 250px; min-height: 100vh;
            background: #1a3c34; position: fixed;
            top: 0; left: 0; z-index: 100;
        }
        #sidebar .sidebar-brand {
            padding: 20px; background: #122b24;
            color: #fff; font-size: 18px;
            font-weight: bold; text-align: center;
            border-bottom: 1px solid #2e4f45;
        }
        #sidebar .nav-link {
            color: #adb5bd; padding: 12px 20px;
            font-size: 14px; display: flex;
            align-items: center; gap: 10px; transition: all 0.2s;
        }
        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            background: #2e4f45; color: #fff;
            border-left: 4px solid #28a745;
        }
        #sidebar .nav-section {
            padding: 10px 20px 5px; color: #6c757d;
            font-size: 11px; text-transform: uppercase;
            letter-spacing: 1px;
        }
        #main-content { margin-left: 250px; min-height: 100vh; }
        #topbar {
            background: #fff; padding: 12px 20px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
            display: flex; justify-content: space-between;
            align-items: center; position: sticky; top: 0; z-index: 99;
        }
        #content { padding: 20px; }
    </style>
</head>
<body>

<div id="sidebar">
    <div class="sidebar-brand">🎓 Teacher Panel</div>
    <nav class="mt-2">
        <div class="nav-section">Main</div>
        <a href="{{ route('teacher.dashboard') }}"
            class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="nav-section">My Classes</div>
        <a href="{{ route('teacher.attendance.index') }}"
            class="nav-link {{ request()->routeIs('teacher.attendance.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-check"></i> Attendance
        </a>
        <a href="{{ route('teacher.marks.index') }}"
            class="nav-link {{ request()->routeIs('teacher.marks.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart"></i> Marks
        </a>

        <div class="nav-section">Communication</div>
        <a href="{{ route('teacher.notices.index') }}"
            class="nav-link {{ request()->routeIs('teacher.notices.*') ? 'active' : '' }}">
            <i class="bi bi-megaphone"></i> Notices
        </a>

        <div class="nav-section">Account</div>
        <a href="{{ route('logout') }}" class="nav-link text-danger"
            onclick="event.preventDefault(); document.getElementById('logout-form-teacher').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        <form id="logout-form-teacher" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </nav>
</div>

<div id="main-content">
    <div id="topbar">
        <span class="fw-bold text-muted">{{ ucfirst(request()->segment(2)) }}</span>
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted small">
                <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
            </span>
            <span class="badge bg-success">Teacher</span>
        </div>
    </div>
    <div id="content">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>