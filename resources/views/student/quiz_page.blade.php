@extends('layouts.student')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">اختبار: {{ $unit->name }}</h2>
        <span class="badge bg-secondary">عدد الأسئلة: {{ count($questions) }}</span>
    </div>
    
    <form action="{{ route('student.quiz.submit') }}" method="POST">
        @csrf
        {{-- وضع الـ unit_id مرة واحدة فقط خارج الحلقة لضمان عدم تكراره --}}
        <input type="hidden" name="unit_id" value="{{ $unit->id }}">

        @foreach($questions as $index => $question)
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="mb-3 fw-bold">{{ $index + 1 }}. {{ $question->question_text }}</h5>
                    
                    @if($question->type == 'true_false')
                        <div class="d-flex gap-4">
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="ans[{{ $question->id }}]" 
                                       id="q{{ $question->id }}_true" value="صح" required>
                                <label class="form-check-label px-2" for="q{{ $question->id }}_true">صح</label>
                            </div>
                            <div class="form-check custom-radio">
                                <input class="form-check-input" type="radio" name="ans[{{ $question->id }}]" 
                                       id="q{{ $question->id }}_false" value="خطأ" required>
                                <label class="form-check-label px-2" for="q{{ $question->id }}_false">خطأ</label>
                            </div>
                        </div>
                    @endif

                    {{-- إذا كان لديك أسئلة اختيار من متعدد --}}
                    @if($question->type == 'mcq')
                        @foreach($question->options as $option)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="ans[{{ $question->id }}]" 
                                       value="{{ trim($option->option_text) }}" required>
                                <label class="form-check-label">{{ $option->option_text }}</label>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach

        <div class="card p-3 shadow-sm bg-light">
            <button type="submit" class="btn btn-success btn-lg w-100 fw-bold">إرسال وتصحيح الإجابات</button>
        </div>
    </form>
</div>

<style>
    .custom-radio .form-check-input:checked {
        background-color: #198754;
        border-color: #198754;
    }
    .card { border-radius: 15px; }
</style>
@endsection