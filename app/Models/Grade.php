<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'exam_session_id',
        'student_id',
        'duration',
        'start_time',
        'end_time',
        'total_correct',
        'grade'
    ];

    // Belongs to Exam
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    // Belongs to ExamSession
    public function exam_session()
    {
        return $this->belongsTo(ExamSession::class);
    }

    // Belongs to Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
