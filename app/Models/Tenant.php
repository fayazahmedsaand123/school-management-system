<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'phone',
        'address',
    ];

    // ================ Teacher belongs to a Tenant ================== //
    public function tenant() {
        return $this->belongsTo(Tenant::class);
    }

    // ================ Teacher has many Courses ================= //

    public function courses() {
        return $this->hasMany(Course::class);
    }
}
