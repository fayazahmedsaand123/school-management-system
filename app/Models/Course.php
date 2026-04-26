<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'teacher_id',
        'name',
        'description',
    ];

    // ============== Course belongs to a Teacher ============== //
    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    // ============= Course has many Enrollments =============== //
    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }

    // ======== Course has many Students (through enrollments) ========== //
    public function students() {
        return $this->belongsToMany(Student::class,'enrollments');
    }

}
