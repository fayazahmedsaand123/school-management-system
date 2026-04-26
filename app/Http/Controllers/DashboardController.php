<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\Tenant;
use Inertia\Inertia;

class DashboardController extends Controller {
    
    public function index() {
        $tenantId = session('tenant_id');

        $stats = [
            'schools'     => Tenant::count(),
            'teachers'    => Teacher::where('tenant_id',$tenantId)->count(),
            'students'    => Student::where('tenant_id',$tenantId)->count(),
            'courses'     => Course::where('tenant_id',$tenantId)->count(),
            'enrollments' => Enrollment::where('tenant_id',$tenantId)->count(),
        ];

        return inertia::render('Dashboard',[
            'stats' => $stats
        ]);
    }
}
