<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
class GradeController extends Controller
{
public function index()
{
    // جلب الصفوف مع حساب عدد الطلاب والمواد المرتبطة بكل صف
    $grades = Grade::withCount(['students', 'subjects'])->get();
    
    return view('admin.grades.index', compact('grades'));
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);
    Grade::create([
        'name' => $request->name
    ]);

    return back()->with('success', 'تم إضافة الصف بنجاح');
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:grades,name,' . $id,
    ]);
    $grade = Grade::findOrFail($id);
    $grade->update([
        'name' => $request->name,
        // 'stage' => $request->stage, 
    ]);

    // 4. العودة مع رسالة نجاح
    return back()->with('success', 'تم تحديث بيانات الصف بنجاح');
}

public function destroy($id)
{
    $grade = Grade::findOrFail($id);
    $grade->delete();
    return back()->with('success', 'تم حذف الصف بنجاح');
}
}
