<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;


    protected $fillable = [
        'exam_id',
        'exam_session_id',
        'question_id',
        'student_id',
        'question_order',
        'answer_order',
        'answer',
        'is_correct'
    ];

    //Belongs to Question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
