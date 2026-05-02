<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';

    protected $fillable = ['name', 'section'];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'class_id');
    }
}