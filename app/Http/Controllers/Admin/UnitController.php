<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Subject;
class UnitController extends Controller
{
    public function index() {
        $units = Unit::with('subject.grade') 
            ->get();
        $subjects = Subject::all();          
        return view('admin.units.index', compact('units', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        Unit::create($request->all());

        return back()->with('success', 'تم إضافة الوحدة بنجاح');
    }

    public function destroy($id)
    {
        Unit::findOrFail($id)->delete();
        return back()->with('success', 'تم حذف الوحدة');
    }
}
