<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Subject;
use App\Models\Unit;
use App\Models\Question;
use App\Models\Exam;

// استيراد الـ Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ResultController;

// 1. التوجيه عند الدخول
Route::get('/', function () {
    if (!auth()->check()) return redirect()->route('login');
    if (auth()->user()->hasRole('admin')) return redirect()->route('admin.dashboard');
    if (auth()->user()->hasRole('student')) return redirect()->route('student.dashboard');
    return redirect()->route('login');
});

// 2. مسارات المسؤول (Admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('grades', GradeController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('units', UnitController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('exams', ExamController::class);
    Route::get('results', [ResultController::class, 'index'])->name('results.index');
    Route::get('get-units/{subjectId}', [QuestionController::class, 'getUnits']);
    Route::get('/admin/results', [App\Http\Controllers\Admin\ResultController::class, 'index'])->name('admin.results');
    Route::delete('/admin/questions/{id}', [App\Http\Controllers\Admin\QuestionController::class, 'destroy'])->name('admin.questions.destroy');
});

// 3. مسارات الطالب (Student) - تم إضافة مسار Submit المفقود
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    
    Route::get('/dashboard', function () {
        $latestExams = Exam::with('subject')->withCount('questions')->latest()->take(5)->get();
        $subjectsCount = Subject::count();
        $examsCount = Exam::count();
        return view('student.dashboard', compact('latestExams', 'subjectsCount', 'examsCount'));
    })->name('dashboard');

    Route::get('/subjects', function () {
    // جلب جميع المواد بدون التقيد برقم الصف لتظهر الثقافة العلمية وكل شيء آخر
    $subjects = Subject::all(); 
    return view('student.subjects', compact('subjects'));
})->name('subjects');

    Route::get('/subjects/{subject_id}/units', function ($subject_id) {
        $subject = Subject::findOrFail($subject_id); 
        $units = Unit::where('subject_id', $subject_id)->get();
        return view('student.units', compact('subject', 'units'));
    })->name('units');

    // مسار عرض صفحة الاختبار
    // مسار الاختبار الموحد
Route::get('/quiz/{unit_id}', function ($unit_id) {
    $unit = \App\Models\Unit::findOrFail($unit_id);
    $questions = \App\Models\Question::where('unit_id', $unit_id)->get();
    return view('student.quiz_page', compact('unit', 'questions'));
})->name('quiz');

  Route::post('/quiz/submit', function (\Illuminate\Http\Request $request) {
    $answers = $request->input('ans', []);
    $unitId = $request->input('unit_id');
    
    if (empty($answers)) {
        return redirect()->back()->with('error', 'يرجى حل الأسئلة أولاً!');
    }

    $reviewData = []; // مصفوفة لتخزين تفاصيل المراجعة
    $correctCount = 0;

    foreach($answers as $questionId => $studentAnswer) {
    $question = \App\Models\Question::find($questionId);
    $isCorrect = false;

    if ($question) {
        // تنظيف النصوص من المسافات المخفية وتوحيدها
        $correct = trim((string)$question->correct_answer);
        $answer  = trim((string)$studentAnswer);

        if ($correct == $answer && $answer !== "") {
            $correctCount++;
            $isCorrect = true;
        }

        $reviewData[] = [
            'question_text' => $question->question_text,
            'student_answer' => $studentAnswer,
            'correct_answer' => $question->correct_answer,
            'is_correct' => $isCorrect
        ];
    }

}

    $total = count($answers);
    $score = ($total > 0) ? ($correctCount / $total) * 100 : 0;

    // حفظ النتيجة الأساسية في قاعدة البيانات
    \App\Models\StudentAnswer::create([
        'user_id' => auth()->id(),
        'unit_id' => $unitId,
        'total_question' => $total,
        'correct_answer' => $correctCount,
        'score' => $score,
    ]);

    // إرسال تفاصيل الأسئلة إلى الصفحة التالية عبر الجلسة (Session)
    return redirect()->route('student.results')->with('reviewData', $reviewData);
})->name('quiz.submit');

Route::get('/student/all-results', function () {
    $results = \App\Models\StudentAnswer::where('user_id', auth()->id())
                ->with('unit.subject') // جلب بيانات الوحدة والمادة المرتبطة
                ->latest()
                ->get();

    return view('student.all_results', compact('results'));
})->name('student.all_results');

    Route::view('/results', 'student.results')->name('results');
});

Route::get('/results', function () {
    // جلب كافة نتائج الطالب الحالي مع بيانات الوحدات المرتبطة بها
    $results = \App\Models\StudentAnswer::where('user_id', auth()->id())
                ->with('unit') // لضمان عرض اسم الوحدة لكل نتيجة
                ->latest()
                ->get();

    // نمرر المتغير بصيغة الجمع $results بدلاً من المفرد
    return view('student.results', compact('results'));
})->name('student.results');
// 4. مسارات الملف الشخصي
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';