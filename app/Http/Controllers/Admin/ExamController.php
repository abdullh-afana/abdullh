<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Unit;
use App\Models\Grade;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with(['subject', 'questions'])->latest()->get();
    
    // جلب المواد لاستخدامها في الفلاتر إن وجدت
    $subjects = Subject::all();

    return view('admin.exams.index', compact('exams', 'subjects'));
    }

    public function create()
    {
        $subjects = Subject::with('units')->get(); 
        $units = Unit::all();
        $grades = Grade::all();
        
        return view('admin.exams.create', compact('subjects', 'units', 'grades'));
    }

   public function store(Request $request)
{
    // ... كود التحقق والأسئلة ...

    $exam = Exam::create([
        'title'      => $request->title,
        'subject_id' => $request->subject_id,
        'duration'   => $request->duration,
        'total_mark' => 100, // أضفنا هذا لأن قاعدتك ترفض القيمة الفارغة فيه
        'type'       => 'random', // قيمة افتراضية للنوع
        'unit_id'    => $request->unit_ids[0] ?? null, // أضفته لأنني أراه في صورتك كحقل مفتاحي
    ]);

    // ... ربط الأسئلة ...
}

    public function show($id)
    {
        $exam = Exam::with(['questions.options', 'subject.grade'])->findOrFail($id);
        return view('admin.exams.show', compact('exam'));
    }

    public function edit($id)
    {
        $exam = Exam::findOrFail($id);
        $subjects = Subject::with('grade')->get();
        $units = Unit::where('subject_id', $exam->subject_id)->get();
        return view('admin.exams.edit', compact('exam', 'subjects', 'units'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'duration' => 'required|integer|min:1',
        ]);

        $exam = Exam::findOrFail($id);
        $exam->update($request->all());

        return redirect()->route('admin.exams.index')->with('success', 'تم تحديث بيانات الاختبار بنجاح');
    }

    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->questions()->detach(); // فك الارتباط مع الأسئلة أولاً
        $exam->delete();
        
        return back()->with('success', 'تم حذف الاختبار بنجاح');
    }
}