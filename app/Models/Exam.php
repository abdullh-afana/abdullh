<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
protected $guarded = [];

    public function questions() {
        return $this->belongsToMany(Question::class);
    }

    // Accessor for questions_count
    public function getQuestionsCountAttribute()
    {
        return $this->questions()->count();
    }

    // Accessor for attempts_count
    public function getAttemptsCountAttribute()
    {
        return $this->attempts()->count();
    }

    // علاقة المادة (ينتمي إلى مادة)
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    // علاقة المحاولات
    public function attempts()
    {
        return $this->hasMany(ExamAttempt::class);
    }

    protected $fillable = ['title', 'subject_id', 'duration', 'total_mark', 'type', 'unit_id','grade_id'];
}

