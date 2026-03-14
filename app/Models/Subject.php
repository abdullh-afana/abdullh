<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
    
}
