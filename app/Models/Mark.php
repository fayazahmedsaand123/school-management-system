<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model {

    protected $fillable = [
        'student_id', 'subject_id', 'total_marks',
        'obtained_marks', 'exam_type'
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }
    
    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}