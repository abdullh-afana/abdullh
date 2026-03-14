@extends('layouts.admin')

@section('title', 'إدارة الأسئلة')

@section('body-class', 'page-admin-questions')

@section('content')
    <header class="page-header">
        <div>
            <div class="page-title-row">
                <h4 class="mb-1">إدارة الأسئلة</h4>
                <span class="page-tag">لوحة الإدارة</span>
            </div>
            <p class="text-muted mb-0">مرحباً بك في لوحة إدارة منصة بنوك الأسئلة</p>
            <nav class="breadcrumb-lite" aria-label="مسار الصفحة">
                <span>لوحة التحكم</span>
                <i class="bi bi-chevron-left"></i>
                <span>إدارة الأسئلة</span>
            </nav>
        </div>
        <button class="btn mobile-menu-btn d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
            <i class="bi bi-list"></i> القائمة
        </button>
    </header>

    <section class="header-actions">
        <div>
            <h5 class="mb-1">إدارة الأسئلة</h5>
            <p class="text-muted mb-0">إضافة وإدارة الأسئلة وربطها بالوحدات الدراسية</p>
        </div>
        <div class="actions-group">
            <button class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                <i class="bi bi-plus-lg"></i> إضافة سؤال جديد
            </button>
        </div>
    </section>

    <section class="questions-list">
        @foreach($questions as $question)
            <div class="question-card reveal">
                <div class="q-head">
                    <span class="level {{ $question->level }}">{{ $question->level == 'easy' ? 'سهل' : ($question->level == 'medium' ? 'متوسط' : 'صعب') }}</span>
                    <div class="q-actions">
                        <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="icon-btn delete" type="submit" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="q-title">
                    <h6>{{ $question->question_text }}</h6>
                    <span class="q-icon"><i class="bi bi-question-circle"></i></span>
                </div>

                <div class="q-meta text-muted small">
                    {{ $question->unit->subject->grade->name ?? '' }} • 
                    {{ $question->unit->subject->name ?? '' }} • 
                    {{ $question->unit->name ?? '' }}
                </div>

                <div class="q-options mt-3">
                    @foreach($question->options as $option)
                        <label class="q-option {{ $option->is_correct ? 'correct' : '' }} border p-2 d-block mb-1 rounded">
                            <input type="radio" disabled {{ $option->is_correct ? 'checked' : '' }}>
                            <span>{{ $option->option_text }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>

    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة سؤال جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="{{ route('admin.questions.store') }}" method="POST" id="questionForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3 form-section">
                            <label class="form-label">نوع السؤال</label>
                            <div class="type-grid d-flex gap-3">
                                <label class="type-card border p-3 rounded cursor-pointer">
                                    <input type="radio" name="type" value="mcq" checked class="type-selector">
                                    <span>اختر من متعدد</span>
                                </label>
                                <label class="type-card border p-3 rounded cursor-pointer">
                                    <input type="radio" name="type" value="true_false" class="type-selector">
                                    <span>صح أو خطأ</span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">نص السؤال</label>
                            <input type="text" name="question_text" class="form-control" placeholder="اكتب نص السؤال هنا..." required>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label class="form-label">الصف</label>
                                <select class="form-select" id="grade_select">
                                    <option value="">اختر الصف</option>
                                    @foreach($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">المادة</label>
                                <select class="form-select" id="subject_select" name="subject_id">
                                    <option value="">اختر المادة</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">الوحدة</label>
                                <select name="unit_id" id="unit_select" class="form-select" required>
                                    <option value="">اختر المادة أولاً</option>
                                </select>
                            </div>
                        </div>

                        <div id="options-container" class="mb-4 p-3 bg-light rounded">
                            <label class="form-label fw-bold">الخيارات الدراسية (حدد الإجابة الصحيحة)</label>
                            <div class="choices-list d-flex flex-column gap-2">
                                @for($i = 0; $i < 4; $i++)
                                <div class="choice-item d-flex align-items-center gap-2">
                                    <input type="radio" name="is_correct" value="{{ $i }}" {{ $i == 0 ? 'checked' : '' }}>
                                    <input type="text" name="options[]" class="form-control" placeholder="الخيار {{ $i+1 }}">
                                </div>
                                @endfor
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">درجة السؤال</label>
                                <input type="number" name="mark" class="form-control" value="1" min="1">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">مستوى الصعوبة</label>
                                <select name="level" class="form-select">
                                    <option value="easy">سهل</option>
                                    <option value="medium" selected>متوسط</option>
                                    <option value="hard">صعب</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary px-4">حفظ السؤال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const subjectSelect = document.getElementById('subject_select');
            const unitSelect = document.getElementById('unit_select');
            const typeSelectors = document.querySelectorAll('.type-selector');
            const optionsContainer = document.querySelector('.choices-list');

            // 1. الربط الديناميكي بين المادة والوحدة
            subjectSelect.addEventListener('change', function () {
                const subjectId = this.value;
                unitSelect.innerHTML = '<option value="">جاري التحميل...</option>';

                if (subjectId) {
                    fetch(`/admin/get-units/${subjectId}`) // تأكد من إنشاء هذا المسار في Route
                        .then(response => response.json())
                        .then(data => {
                            unitSelect.innerHTML = '<option value="">اختر الوحدة</option>';
                            data.forEach(unit => {
                                unitSelect.innerHTML += `<option value="${unit.id}">${unit.name}</option>`;
                            });
                        });
                } else {
                    unitSelect.innerHTML = '<option value="">اختر المادة أولاً</option>';
                }
            });

            // 2. تغيير شكل الخيارات بناءً على نوع السؤال (MCQ أو صح وخطأ)
            typeSelectors.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (this.value === 'true_false') {
                        optionsContainer.innerHTML = `
                            <div class="choice-item d-flex align-items-center gap-2">
                                <input type="radio" name="is_correct" value="0" checked>
                                <input type="text" name="options[]" class="form-control" value="صح" readonly>
                            </div>
                            <div class="choice-item d-flex align-items-center gap-2">
                                <input type="radio" name="is_correct" value="1">
                                <input type="text" name="options[]" class="form-control" value="خطأ" readonly>
                            </div>
                        `;
                    } else {
                        // إعادة الخيارات الأربعة للاختيار من متعدد
                        let html = '';
                        for (let i = 0; i < 4; i++) {
                            html += `
                                <div class="choice-item d-flex align-items-center gap-2">
                                    <input type="radio" name="is_correct" value="${i}" ${i === 0 ? 'checked' : ''}>
                                    <input type="text" name="options[]" class="form-control" placeholder="الخيار ${i + 1}" required>
                                </div>`;
                        }
                        optionsContainer.innerHTML = html;
                    }
                });
            });
        });
    </script>
@endsection