<?php
// Admin
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\MarksController;
use App\Http\Controllers\Admin\NoticeController;

// Student
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Student\AttendanceController as StudentAttendance;
use App\Http\Controllers\Student\MarksController as StudentMarks;
use App\Http\Controllers\Student\NoticeController as StudentNotice;

// Teacher
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboard;
use App\Http\Controllers\Teacher\AttendanceController as TeacherAttendance;
use App\Http\Controllers\Teacher\MarksController as TeacherMarks;
use App\Http\Controllers\Teacher\NoticeController as TeacherNotice;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    // Classes
    Route::resource('classes', ClassController::class);

    // Subjects
    Route::resource('subjects', SubjectController::class);

    // Students
    Route::resource('students', StudentController::class);

    // Teachers
    Route::resource('teachers', TeacherController::class);

    // Attendance
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/take', [AttendanceController::class, 'take'])->name('attendance.take');
    Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/attendance/report', [AttendanceController::class, 'report'])->name('attendance.report');

    // Marks
    Route::get('/marks', [MarksController::class, 'index'])->name('marks.index');
    Route::get('/marks/create', [MarksController::class, 'create'])->name('marks.create');
    Route::post('/marks/store', [MarksController::class, 'store'])->name('marks.store');
    Route::get('/marks/result', [MarksController::class, 'result'])->name('marks.result');
    Route::get('/marks/{mark}/edit', [MarksController::class, 'edit'])->name('marks.edit');
    Route::put('/marks/{mark}/update', [MarksController::class, 'update'])->name('marks.update');
    Route::delete('/marks/{mark}/destroy', [MarksController::class, 'destroy'])->name('marks.destroy');

    // Notice
    Route::resource('notices', NoticeController::class);

});

// Teacher
Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherDashboard::class, 'index'])->name('dashboard');

    // Attendance
    Route::get('/attendance', [TeacherAttendance::class, 'index'])->name('attendance.index');

    // Marks
    Route::get('/marks', [TeacherMarks::class, 'index'])->name('marks.index');

    // Notices
    Route::get('/notices', [TeacherNotice::class, 'index'])->name('notices.index');
});

// Student
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('dashboard');

    // Attendance
    Route::get('/attendance', [StudentAttendance::class, 'index'])->name('attendance.index');

    // Marks
    Route::get('/marks', [StudentMarks::class, 'index'])->name('marks.index');

    // Notices
    Route::get('/notices', [StudentNotice::class, 'index'])->name('notices.index');
});

// Parent
Route::middleware(['auth', 'role:parent'])->prefix('parent')->name('parent.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'parent'])->name('dashboard');
});
