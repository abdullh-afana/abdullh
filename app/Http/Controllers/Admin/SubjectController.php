<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Grade;
class SubjectController extends Controller
{
public function index()
{
    $subjects = Subject::with('grade')
        ->withCount('units') 
        ->get();
        
    $grades = Grade::all();
    
    return view('admin.subjects.index', compact('subjects', 'grades'));
}
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'grade_id' => 'required|exists:grades,id'
        ]);
        Subject::create($request->all());
        return back()->with('success', 'تم إضافة المادة بنجاح');
    }
}
