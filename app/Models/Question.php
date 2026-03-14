<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    // استخدام fillable أفضل للأمان أو ابقاء guarded فارغة كما هي
    protected $guarded = [];

    /**
     * العلاقة مع الوحدة الدراسية
     * كل سؤال ينتمي إلى وحدة واحدة
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function exam()
    {
        return $this->belongsToMany(Exam::class);    
    }
}