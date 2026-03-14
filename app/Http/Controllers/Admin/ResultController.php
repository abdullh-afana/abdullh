<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentAnswer;

class ResultController extends Controller
{
    public function index()
{
    // جلب النتائج مع العلاقات التي عرفناها للتو
    $results = \App\Models\StudentAnswer::with(['user', 'unit.subject'])
                ->latest()
                ->paginate(10);

    return view('admin.results.index', compact('results'));
}
}