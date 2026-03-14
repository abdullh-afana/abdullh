<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // دالة عرض المواد الدراسية
    public function subjects()
{
    // بدلاً من الفلترة حسب الصف، سنطلب منه جلب كل المواد بلا استثناء
    $subjects = \App\Models\Subject::all(); 

    return view('student.subjects', compact('subjects'));
}
    // دالة عرض نتائج الطالب
    public function results()
    {
        $results = StudentAnswer::where('user_id', auth()->id())
                    ->with('unit.subject')
                    ->latest()
                    ->get();
                    
        return view('student.results', compact('results'));
    }
}