@extends('layouts.admin')

@section('title', 'معاينة الاختبار')

@section('content')
<div class="container-fluid py-4">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">{{ $exam->title }}</h4>
            <p class="text-muted small">
                {{ $exam->subject->grade->name ?? '' }} • {{ $exam->subject->name ?? '' }}
            </p>
        </div>
        <a href="{{ route('admin.exams.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-right"></i> عودة للقائمة
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3 border-bottom pb-2">تفاصيل الاختبار</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2 d-flex justify-content-between">
                            <span><i class="bi bi-clock me-2"></i> المدة:</span>
                            <span class="badge bg-light text-dark">{{ $exam->duration }} دقيقة</span>
                        </li>
                        <li class="mb-2 d-flex justify-content-between">
                            <span><i class="bi bi-question-circle me-2"></i> عدد الأسئلة:</span>
                            <span class="badge bg-primary">{{ $exam->questions_count ?? $exam->questions->count() }}</span>
                        </li>
                        <li class="mb-2 d-flex justify-content-between">
                            <span><i class="bi bi-person-check me-2"></i> المحاولات:</span>
                            <span class="badge bg-secondary">{{ $exam->attempts_count }} مرة</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <h6 class="fw-bold mb-3">الأسئلة المضافة</h6>
            @forelse($exam->questions as $index => $question)
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-3 text-primary">سؤال {{ $index + 1 }}</h6>
                            <span class="badge bg-info text-white">{{ $question->level }}</span>
                        </div>
                        <p class="fw-bold">{{ $question->question_text }}</p>
                        
                        <div class="options-list mt-3">
                            @foreach($question->options as $option)
                                <div class="p-2 border rounded mb-2 {{ $option->is_correct ? 'bg-success text-white' : 'bg-light' }}">
                                    {{ $option->option_text }}
                                    @if($option->is_correct) <i class="bi bi-check-circle-fill ms-2"></i> @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center">لا توجد أسئلة مضافة لهذا الاختبار بعد.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection