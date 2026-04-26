<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'student_id',
        'course_id',
    ];

    // ======== Enrollment belongs to a Tenant ============ //
    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

    // ========== Enrollment belongs to a Tenant ========== //
    public function student() {
        return $this->belongsTo(Student::class);
    }

    // ========== Enrollment belongs to a Course =========== //
    public function course() {
        return $this->belongsTo(Course::class);
    }



}
