<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            min-height: 100vh;
            background: #f4f6f9;
        }

        /* Sidebar */
        #sidebar {
            width: 250px;
            min-height: 100vh;
            background: #1e2a38;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            transition: all 0.3s;
        }

        #sidebar .sidebar-brand {
            padding: 20px;
            background: #161f2b;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #2e3f52;
        }

        #sidebar .nav-link {
            color: #adb5bd;
            padding: 12px 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s;
        }

        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            background: #2e3f52;
            color: #fff;
            border-left: 4px solid #0d6efd;
        }

        #sidebar .nav-section {
            padding: 10px 20px 5px;
            color: #6c757d;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Main Content */
        #main-content {
            margin-left: 250px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* Topbar */
        #topbar {
            background: #fff;
            padding: 12px 20px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        /* Content Area */
        #content {
            padding: 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #sidebar {
                width: 0;
                overflow: hidden;
            }
            #main-content {
                margin-left: 0;
            }
            #sidebar.show {
                width: 250px;
            }
        }
    </style>
</head>
<body>

{{-- ===== SIDEBAR ===== --}}
<div id="sidebar">

    {{-- Brand --}}
    <div class="sidebar-brand">
        🏫 School MS
    </div>

    {{-- Navigation --}}
    <nav class="mt-2">

        {{-- Dashboard --}}
        <div class="nav-section">Main</div>
        <a href="{{ route('admin.dashboard') }}"
            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        {{-- Academics --}}
        <div class="nav-section">Academics</div>
        <a href="{{ route('admin.classes.index') }}"
            class="nav-link {{ request()->routeIs('admin.classes.*') ? 'active' : '' }}">
            <i class="bi bi-building"></i> Classes
        </a>
        <a href="{{ route('admin.subjects.index') }}"
            class="nav-link {{ request()->routeIs('admin.subjects.*') ? 'active' : '' }}">
            <i class="bi bi-book"></i> Subjects
        </a>

        {{-- People --}}
        <div class="nav-section">People</div>
        <a href="{{ route('admin.students.index') }}"
            class="nav-link {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Students
        </a>
        <a href="{{ route('admin.teachers.index') }}"
            class="nav-link {{ request()->routeIs('admin.teachers.*') ? 'active' : '' }}">
            <i class="bi bi-person-badge"></i> Teachers
        </a>

        {{-- Attendance --}}
        <div class="nav-section">Attendance</div>
        <a href="{{ route('admin.attendance.index') }}"
            class="nav-link {{ request()->routeIs('admin.attendance.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-check"></i> Attendance
        </a>

        {{-- Marks --}}
        <div class="nav-section">Marks</div>
        <a href="{{ route('admin.marks.index') }}"
            class="nav-link {{ request()->routeIs('admin.marks.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart"></i> Marks
        </a>
        <a href="{{ route('admin.marks.result') }}"
            class="nav-link">
            <i class="bi bi-trophy"></i> Result Sheet
        </a>

        {{-- Notice --}}
        <div class="nav-section">Communication</div>
        <a href="{{ route('admin.notices.index') }}"
            class="nav-link {{ request()->routeIs('admin.notices.*') ? 'active' : '' }}">
            <i class="bi bi-megaphone"></i> Notice Board
        </a>

        {{-- Logout --}}
        <div class="nav-section">Account</div>
        <a href="{{ route('logout') }}"
            class="nav-link text-danger"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    </nav>
</div>

{{-- ===== MAIN CONTENT ===== --}}
<div id="main-content">

    {{-- Topbar --}}
    <div id="topbar">
        <div class="d-flex align-items-center gap-2">
            {{-- Mobile Toggle --}}
            <button class="btn btn-sm btn-outline-secondary d-md-none" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <span class="fw-bold text-muted">
                {{ ucfirst(request()->segment(2)) }}
            </span>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="text-muted small">
                <i class="bi bi-person-circle"></i>
                {{ auth()->user()->name }}
            </span>
            <span class="badge bg-danger">Admin</span>
        </div>
    </div>

    {{-- Page Content --}}
    <div id="content">
        @yield('content')
    </div>

</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

{{-- Mobile Sidebar Toggle --}}
<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('show');
    });
</script>

</body>
</html>