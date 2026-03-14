<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAnswer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function attempt()
    {
        return $this->belongsTo(ExamAttempt::class);
    }

protected $fillable = ['user_id', 'unit_id', 'total_question', 'correct_answer', 'score'];
    public function unit() {
        return $this->belongsTo(Unit::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function selectedOption()
    {
        return $this->belongsTo(Option::class, 'selected_option_id');
    }
}