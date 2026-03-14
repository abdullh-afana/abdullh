@extends('layouts.student')

@section('content')
<div class="container py-5">
    {{-- عرض اسم المادة ديناميكياً --}}
    <h3 class="fw-bold text-center mb-4">وحدات مادة: {{ $subject->name }}</h3> 

    <div class="row g-3">
        @forelse($units as $unit)
            <div class="col-12 col-md-6">
                <div class="p-3 bg-white border rounded shadow-sm d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0 fw-bold">{{ $unit->name }}</h5>
                        <small class="text-muted">اضغط للبدء في الاختبار</small>
                    </div>
                    {{-- ربط زر البداية بمسار الاختبار الذي سننشئه --}}
                    <a href="{{ route('student.quiz', $unit->id) }}" class="btn btn-primary">ابدأ الآن</a>
                </div>
            </div>
        @empty
            <div class="text-center p-5">
                <p class="text-muted">لا توجد وحدات مضافة لهذه المادة بعد.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection