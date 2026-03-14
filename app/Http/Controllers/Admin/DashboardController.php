<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\User;
class DashboardController extends Controller
{
public function index()
{
    // 1. الإحصائيات العلوية
    $stats = [
        'students_count' => User::count(),
        'subjects_count'  => Subject::count(),
        'exams_count'     => Exam::count(),
        'questions_count' => Question::count(),
    ];

    // 2. أحدث الاختبارات مع عد الأسئلة
    $latestExams = Exam::with('subject')
    ->withCount('questions') // هذا السطر هو الذي يملأ متغير questions_count
    ->latest()
    ->take(5)
    ->get();

    // 3. أحدث المواد
    $latestSubjects = Subject::with(['grade', 'units'])
        ->latest()
        ->take(3)
        ->get();

    // 4. جلب أحدث العمليات لقسم "نشاط النظام"
    $lastSubject  = Subject::latest()->first();
    $lastExam     = Exam::latest()->first();
    $lastQuestion = Question::with('unit')->latest()->first();

    return view('admin.dashboard', compact(
        'stats', 
        'latestExams', 
        'latestSubjects', 
        'lastSubject', 
        'lastExam', 
        'lastQuestion'
    ));
}
}
