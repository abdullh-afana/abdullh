<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Option;
use App\Models\Unit;
use App\Models\Subject;
use App\Models\Grade;

class QuestionController extends Controller
{

public function index()
{
    $questions = Question::with(['unit.subject.grade', 'options'])->latest()->get();
    $grades = Grade::all();
    $subjects = Subject::all();
    $units = Unit::all();
    return view('admin.questions.index', compact('questions', 'grades', 'subjects', 'units'));
}
public function store(Request $request)
{
    $request->validate([
        'question_text' => 'required',
        'unit_id' => 'required|exists:units,id',
        'type' => 'required|in:mcq,true_false',
        'mark' => 'required|integer',
        'options' => 'required|array|min:2', 
        'is_correct' => 'required' 
    ]);

    $question = Question::create([
        'question_text' => $request->question_text,
        'unit_id' => $request->unit_id,
        'type' => $request->type,
        'mark' => $request->mark,
        'correct_answer' => $request->is_correct,
    ]);

    foreach ($request->options as $index => $optionText) {
        $question->options()->create([
            'option_text' => $optionText,
            'is_correct' => ($index == $request->is_correct) 
        ]);
    }

    return back()->with('success', 'تم إضافة السؤال بنجاح');
}
// في ملف QuestionController.php
public function getUnits($subjectId) {
    // جلب الوحدات المرتبطة بالمادة المختارة فقط
    $units = Unit::where('subject_id', $subjectId)->get();
    return response()->json($units);
}

public function destroy($id)
{
    // البحث عن السؤال وحذفه
    $question = \App\Models\Question::findOrFail($id);
    $question->delete();

    // العودة مع رسالة نجاح
    return redirect()->back()->with('success', 'تم حذف السؤال بنجاح');
}

}
