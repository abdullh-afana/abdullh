@extends('layouts.student')

@section('title', 'لوحة الطالب')

@section('content')
{{-- استدعاء ملف الـ CSS الخاص بصديقك --}}
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<header class="main-header mb-4">
    <div class="container-fluid">
        <div class="header-row d-flex justify-content-between align-items-center py-3 px-4">
            <div class="header-brand d-flex align-items-center gap-3">
                <img src="{{ asset('img/logo.jpg') }}" class="logo rounded-circle" alt="الشعار" style="width: 45px; height: 45px;">
                <span class="brand-title fw-bold text-primary fs-4">منصة بنوك الأسئلة</span>
            </div>

            <div class="header-user text-end d-none d-md-block">
                <span class="user-name fw-bold d-block text-dark">{{ auth()->user()->name }}</span>
                <span class="user-grade small text-muted badge bg-light border text-dark">{{ auth()->user()->grade->name ?? 'غير محدد' }}</span>
            </div>

            <div class="header-left d-flex align-items-center gap-2">
                <a class="btn btn-outline-primary btn-sm rounded-pill px-3 d-none d-lg-inline-block" href="{{ route('student.subjects') }}">
                    <i class="bi bi-book me-1"></i> المواد
                </a>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3">
                        <i class="bi bi-box-arrow-right"></i> خروج
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<div class="container-fluid px-5 pb-5">
    {{-- رسالة الترحيب --}}
    <div class="welcome-header mb-5">
        <h1 class="hero-name fw-bold display-5" style="color: #2d3436;">مرحباً، {{ explode(' ', auth()->user()->name)[0] }} 👋</h1>
        <p class="text-muted fs-5">استمر في التقدم نحو أهدافك الدراسية، نحن فخورون بك!</p>
    </div>

    {{-- بطاقات الإحصائيات الملونة (تصميم صديقك + بياناتك) --}}
    <div class="row g-4 mb-5">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="stat-card shadow-sm border-0 h-100 p-4 bg-white rounded-4 d-flex align-items-center gap-3">
                <div class="icon-box bg-blue-subtle text-primary p-3 rounded-4 fs-3">
                    <i class="bi bi-book-half"></i>
                </div>
                <div>
                    <small class="text-muted d-block fw-bold">المواد المسجلة</small>
                    <div class="fw-bold fs-4 text-dark">{{ $subjectsCount ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="stat-card shadow-sm border-0 h-100 p-4 bg-white rounded-4 d-flex align-items-center gap-3">
                <div class="icon-box bg-purple-subtle text-purple p-3 rounded-4 fs-3" style="background-color: #f3e8ff; color: #7c3aed;">
                    <i class="bi bi-pencil-square"></i>
                </div>
                <div>
                    <small class="text-muted d-block fw-bold">اختبارات منجزة</small>
                    <div class="fw-bold fs-4 text-dark">{{ $examsCount ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="stat-card shadow-sm border-0 h-100 p-4 bg-white rounded-4 d-flex align-items-center gap-3">
                <div class="icon-box bg-green-subtle text-success p-3 rounded-4 fs-3" style="background-color: #dcfce7; color: #16a34a;">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <div>
                    <small class="text-muted d-block fw-bold">متوسط المعدل</small>
                    <div class="fw-bold fs-4 text-dark">85%</div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="stat-card shadow-sm border-0 h-100 p-4 bg-white rounded-4 d-flex align-items-center gap-3">
                <div class="icon-box bg-orange-subtle text-warning p-3 rounded-4 fs-3" style="background-color: #ffedd5; color: #ea580c;">
                    <i class="bi bi-stopwatch"></i>
                </div>
                <div>
                    <small class="text-muted d-block fw-bold">ساعات الدراسة</small>
                    <div class="fw-bold fs-4 text-dark">12 ساعة</div>
                </div>
            </div>
        </div>
    </div>

    {{-- أزرار الإجراءات السريعة --}}
    <div class="row g-4 mb-5">
        <div class="col-12 col-md-6">
            <a href="{{ route('student.subjects') }}" class="text-decoration-none h-100">
                <div class="action-card p-5 rounded-4 text-white shadow-lg border-0 h-100 position-relative overflow-hidden" 
                     style="background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);">
                    <div class="position-relative z-index-1">
                        <i class="bi bi-play-circle-fill display-4 mb-3 d-block"></i>
                        <h3 class="fw-bold">ابدأ اختباراً جديداً</h3>
                        <p class="mb-0 opacity-75">اختر المادة والوحدة وتحدى نفسك الآن!</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6">
            <a href="{{ route('student.results') }}" class="text-decoration-none h-100">
                <div class="action-card p-5 rounded-4 bg-white shadow-sm border border-light h-100">
                    <i class="bi bi-trophy-fill display-4 text-warning mb-3 d-block"></i>
                    <h3 class="fw-bold text-dark">عرض سجل النتائج</h3>
                    <p class="text-muted mb-0">راجع نقاط قوتك وضعفك في الاختبارات السابقة.</p>
                </div>
            </a>
        </div>
    </div>

    {{-- الاختبارات المتاحة (بيانات حقيقية من كودك) --}}
    <div class="recent-exams-section">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark m-0"><i class="bi bi-lightning-charge-fill text-warning me-2"></i>أحدث الاختبارات المتاحة</h4>
            <a href="{{ route('student.subjects') }}" class="btn btn-link text-decoration-none fw-bold">عرض الكل</a>
        </div>

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="list-group list-group-flush">
                @forelse($latestExams as $exam)
                <div class="list-group-item p-4 border-start border-4 border-primary bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-circle bg-light text-primary p-3 rounded-circle">
                                <i class="bi bi-journal-check fs-4"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">{{ $exam->title }}</h6>
                                <span class="text-muted small">
                                    <i class="bi bi-tag me-1"></i> {{ $exam->subject->name ?? 'مادة عامة' }} 
                                    <span class="mx-2">|</span>
                                    <i class="bi bi-list-ol me-1"></i> {{ $exam->questions_count }} سؤال
                                </span>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('student.quiz', ['unit_id' => $exam->unit_id]) }}" class="btn btn-primary rounded-pill px-4 fw-bold">
                                ابدأ الاختبار <i class="bi bi-arrow-left ms-1"></i>
                            </a>
                            <div class="text-muted mt-2 small" style="font-size: 0.7rem;">أضيف بتاريخ: {{ $exam->created_at->format('Y/m/d') }}</div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-5 text-center text-muted">
                    <i class="bi bi-emoji-smile fs-1 d-block mb-3 opacity-25"></i>
                    <p>لا توجد اختبارات جديدة اليوم، استمتع بوقتك!</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>


@endsection