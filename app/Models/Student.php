<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'phone',
        'dob',
    ];

    // =============== Student belongs to a Tenant ============== //
    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

    // ================ Student has many Enrollments ============== //
    public function enrollments() {
        return $this->hasMany(Tenant::class);
    }

    // ================ Student belongs to many courses (through enrollments) =============== //
    public function courses() {
        return $this->belongsToMany(Course::class);
    }
}
