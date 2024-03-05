<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'lesson_id',
        'classroom_id',
        'duration',
        'description',
        'random_question',
        'random_answer',
        'show_answer'
    ];

    // Belongs to lesson
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    // Belongs to classroom
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    // Has Many to question
    public function question()
    {
        return $this->hasMany(Question::class)->orderBy('id', 'DESC');
    }
}
