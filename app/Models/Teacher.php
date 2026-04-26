<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'phone',
        'subject',
    ];

    // Teacher belongs to a Tenant
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    // Teacher has many Courses
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}