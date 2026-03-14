@extends('layouts.student')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">المواد الدراسية</h2>
        <p class="text-muted">اختر المادة للانتقال للوحدات</p>
    </div>

    <div class="row g-4 justify-content-center">
        {{-- هذه الحلقة هي السر لظهور كل المواد --}}
        @foreach($subjects as $subject)
            <div class="col-12 col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-4 text-center bg-white border">
                    <div class="icon-box mb-3 mx-auto shadow-sm" style="width: 70px; height: 70px; background: #f0f7ff; border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-book fs-2 text-primary"></i>
                    </div>
                    <h4 class="fw-bold mb-3">{{ $subject->name }}</h4>
                    <a href="{{ route('student.units', $subject->id) }}" class="btn btn-primary w-100 rounded-pill py-2">
                        دخول المادة <i class="bi bi-arrow-left ms-1"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection