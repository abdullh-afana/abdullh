@extends('layouts.admin')

@section('title', 'إنشاء اختبار جديد')
@section('body-class', 'page-admin-exam-create')

@section('content')
<header class="page-header">
    <div>
        <div class="page-title-row">
            <h4 class="mb-1">إنشاء اختبار جديد</h4>
            <span class="page-tag">لوحة الإدارة</span>
        </div>
        <p class="text-muted mb-0">مرحباً بك في لوحة إدارة منصة بنوك الأسئلة</p>
        <nav class="breadcrumb-lite" aria-label="مسار الصفحة">
            <span>لوحة التحكم</span>
            <i class="bi bi-chevron-left"></i>
            <span>إنشاء اختبار جديد</span>
        </nav>
    </div>
    <button class="btn mobile-menu-btn d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
        <i class="bi bi-list"></i> القائمة
    </button>
</header>

<form action="{{ route('admin.exams.store') }}" method="POST">
    @csrf
    <section class="create-layout">
        {{-- ملخص الاختبار الجانبي --}}
        <aside class="summary-card">
            <h6>ملخص الاختبار</h6>
            <div class="summary-item">
                <span>عدد الأسئلة المطلوب</span>
                <strong id="summary-q-count">20</strong>
            </div>
            <div class="summary-item">
                <span>المدة</span>
                <strong id="summary-duration">45 دقيقة</strong>
            </div>
            <div class="summary-item">
                <span>الوحدات المختارة</span>
                <strong id="selected-units-count">0</strong>
            </div>
            <div class="summary-item">
                <span>الحالة</span>
                <strong class="text-primary">مسودة</strong>
            </div>
        </aside>

        {{-- نموذج الإدخال الرئيسي --}}
        <section class="form-card">
            @if(session('error'))
                <div class="alert alert-danger mb-4">{{ session('error') }}</div>
            @endif

            <h6>عنوان الاختبار</h6>
            <input type="text" name="title" class="form-control mb-4" placeholder="مثال: اختبار الرياضيات - الوحدة الأولى" required value="{{ old('title') }}">

            <div class="form-row">
                <div>
                    <label class="form-label">الصف الدراسي</label>
                    <select name="grade_id" class="form-select" id="grade-select">
                        <option value="">اختر الصف</option>
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">المادة الدراسية</label>
                    <select name="subject_id" class="form-select" id="subject-select" required>
                        <option value="">اختر المادة</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" data-grade="{{ $subject->grade_id }}">
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label class="form-label">المدة (بالدقائق)</label>
                    <div class="input-icon">
                        <input type="number" name="duration" id="input-duration" class="form-control" value="45" required min="1">
                        <i class="bi bi-clock"></i>
                    </div>
                </div>
                <div>
                    <label class="form-label">عدد الأسئلة</label>
                    <div class="input-icon">
                        <input type="number" name="question_count" id="input-q-count" class="form-control" value="20" required min="1">
                        <i class="bi bi-question-circle"></i>
                    </div>
                </div>
            </div>

            <div class="form-row single mt-4">
                <div>
                    <label class="form-label fw-bold">اختر الوحدات (تظهر الوحدات بعد اختيار المادة)</label>
                    <div class="unit-grid" id="unit-container">
                        @foreach($units as $unit)
                        <label class="unit-card reveal" data-subject="{{ $unit->subject_id }}" style="display: none;">
                            <input type="checkbox" name="unit_ids[]" value="{{ $unit->id }}" class="unit-checkbox">
                            <div class="unit-title">{{ $unit->name }}</div>
                            <div class="unit-meta">الوحدة رقم {{ $loop->iteration }}</div>
                        </label>
                        @endforeach
                        <div id="no-subject-msg" class="text-muted p-3 border rounded text-center w-100">
                            يرجى اختيار مادة دراسية أولاً لتظهر الوحدات المتاحة
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn generate-btn mt-4 w-100 py-3">
                <i class="bi bi-magic"></i> حفظ الاختبار وتوليد الأسئلة عشوائياً
            </button>
        </section>
    </section>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const qInput = document.getElementById('input-q-count');
        const dInput = document.getElementById('input-duration');
        const subjectSelect = document.getElementById('subject-select');
        const unitCards = document.querySelectorAll('.unit-card');
        const checkboxes = document.querySelectorAll('.unit-checkbox');
        const noSubjectMsg = document.getElementById('no-subject-msg');

        // 1. تحديث الأرقام في الملخص الجانبي فورياً
        qInput.addEventListener('input', () => document.getElementById('summary-q-count').innerText = qInput.value);
        dInput.addEventListener('input', () => document.getElementById('summary-duration').innerText = dInput.value + ' دقيقة');

        // 2. فلترة الوحدات بناءً على المادة المختارة
        subjectSelect.addEventListener('change', function() {
            const selectedSubject = this.value;
            let found = false;

            unitCards.forEach(card => {
                if (card.dataset.subject == selectedSubject) {
                    card.style.display = 'block';
                    found = true;
                } else {
                    card.style.display = 'none';
                    card.querySelector('input').checked = false; // إلغاء تحديد الوحدات المخفية
                }
            });

            // إخفاء أو إظهار رسالة التنبيه
            noSubjectMsg.style.display = (found || selectedSubject === "") ? 'none' : 'block';
            if(selectedSubject === "") noSubjectMsg.style.display = 'block';
            
            // إعادة تصفير عداد الوحدات المختارة عند تغيير المادة
            document.getElementById('selected-units-count').innerText = 0;
        });

        // 3. تحديث عداد الوحدات المختارة في الملخص
        checkboxes.forEach(box => {
            box.addEventListener('change', () => {
                const checkedCount = document.querySelectorAll('.unit-checkbox:checked').length;
                document.getElementById('selected-units-count').innerText = checkedCount;
            });
        });
    });
</script>
@endsection