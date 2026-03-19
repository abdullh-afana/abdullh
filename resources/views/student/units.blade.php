<x-guest-layout>
{{-- استدعاء ملفات الـ CSS والخطوط --}}
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@400;600;700&display=swap" rel="stylesheet">

<body class="page-units">
    {{-- هيدر صديقك الموحد المربوط بـ Laravel --}}
    <nav class="navbar student-header px-4 py-3 shadow-sm bg-white">
        <div class="header-simple d-flex justify-content-between w-100 align-items-center">
            <a class="brand-wrap text-decoration-none text-dark d-flex align-items-center gap-2" href="{{ route('student.dashboard') }}">
                <img src="{{ asset('img/logo.jpg') }}" class="img-fluid" height="44" width="44" alt="الشعار">
                <strong class="text-primary brand-title">منصة بنوك الأسئلة</strong>
            </a>
            <a href="{{ route('student.subjects') }}" class="back-link-inline text-decoration-none text-dark d-flex align-items-center gap-2">
                <span>رجوع للمواد</span><i class="bi bi-arrow-left"></i>
            </a>
        </div>
    </nav>

    <div class="container my-5">
        {{-- قسم العنوان الديناميكي --}}
        <div class="page-box text-center mb-5">
            <span id="subjectBadge" class="badge bg-primary px-3 py-2 rounded-pill mb-2">
                {{ $subject->name }}
            </span>
            <h2 id="subjectTitle" class="fw-bold mt-2" style="font-family: 'Noto Kufi Arabic';">وحدات المادة</h2>
            <p class="text-muted mb-0">اختر الوحدة الدراسية لبدء التحدي والاختبار</p>
        </div>

        <h5 class="fw-bold mb-4 text-center">الفصل الدراسي الحالي</h5>
        
        <div class="d-grid gap-3 mb-4">
            {{-- حلقة التكرار للباك إند --}}
            @forelse($units as $unit)
                <div class="unit-card reveal d-flex justify-content-between align-items-center p-3 bg-white shadow-sm rounded-3 border">
                    <div>
                        <div class="unit-title fw-bold text-dark fs-5">{{ $unit->name }}</div>
                        {{-- الكود الآمن البديل للسطر 41 --}}
<div class="unit-meta text-muted small mt-1">
    <i class="bi bi-question-circle me-1"></i>
    عدد الأسئلة: متنوع • 
    <i class="bi bi-clock me-1"></i> المدة: 30 دقيقة
</div>
                    </div>
                    
                    {{-- زر البداية المربوط بمسارك --}}
                    <a href="{{ route('student.quiz', $unit->id) }}" class="btn btn-start rounded-pill px-4 fw-bold shadow-sm" 
                       style="background-color: #7c3aed; color: white; border: none;">
                        ابدأ الاختبار
                    </a>
                </div>
            @empty
                <div class="text-center p-5 bg-light rounded-4">
                    <i class="bi bi-folder-x fs-1 text-muted"></i>
                    <p class="text-muted mt-2">لا توجد وحدات مضافة لهذه المادة حالياً.</p>
                </div>
            @endforelse
        </div>

        {{-- قسم الفصل الثاني (ثابت كما في تصميم صديقك) --}}
        <div class="mt-5 text-center">
            <h5 class="fw-bold mb-2 text-muted">الفصل الدراسي القادم</h5>
            <p class="text-muted small">سوف يتم عرض الوحدات مع بداية الفصل الجديد</p>
        </div>
    </div>
</body>


</x-guest-layout>