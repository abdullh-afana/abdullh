@extends('layouts.student')

@section('title', 'لوحة الطالب')

@section('body-class', 'page-dashboard-student')

@section('content')
    <header class="main-header shadow-sm bg-white py-2 mb-4">
        <div class="container-fluid">
            <div class="header-row d-flex justify-content-between align-items-center">
                <div class="header-brand d-flex align-items-center">
                    <img src="{{ asset('img/logo.jpg') }}" class="logo-img me-2" alt="الشعار" style="width: 40px; height: 40px; border-radius: 50%;">
                    <span class="brand-title fw-bold text-primary d-none d-sm-inline">منصة بنوك الأسئلة</span>
                </div>

                <div class="header-user d-flex flex-column align-items-end me-3">
                    <span class="user-name fw-bold">{{ auth()->user()->name }}</span>
                    <span class="user-grade small text-muted">{{ auth()->user()->grade->name ?? 'غير محدد' }}</span>
                </div>

                <div class="header-left d-flex align-items-center">
                    <button class="btn btn-outline-primary btn-sm d-md-none me-2" data-bs-toggle="collapse" data-bs-target="#studentHeaderMenu">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="header-actions header-actions-menu collapse d-md-flex align-items-center gap-2" id="studentHeaderMenu">
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('student.subjects') }}">
                            <i class="bi bi-book"></i> <span class="d-none d-lg-inline">المواد</span>
                        </a>
                        <a class="btn btn-outline-secondary btn-sm" href="{{ route('profile.edit') }}">
                            <i class="bi bi-gear"></i> <span class="d-none d-lg-inline">الملف الشخصي</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-box-arrow-right"></i> خروج</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container main-content pb-5">
        <div class="welcome-section mb-4">
            <h2 class="welcome-text fw-bold mb-1">مرحباً، {{ auth()->user()->name }}</h2>
            <p class="text-muted" style="font-size: 1.1rem;">استمر في التقدم نحو أهدافك الدراسية</p>
        </div>

        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="stat-card p-3 shadow-sm rounded bg-white h-100 reveal d-flex align-items-center">
                    <div class="icon-box bg-primary text-white p-2 rounded me-3"><i class="bi bi-book fs-4"></i></div>
                    <div>
                        <small class="text-muted d-block">المواد</small>
                        <div class="fw-bold fs-5">{{ $subjectsCount ?? 0 }}</div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card p-3 shadow-sm rounded bg-white h-100 reveal d-flex align-items-center">
                    <div class="icon-box bg-info text-white p-2 rounded me-3"><i class="bi bi-pencil-square fs-4"></i></div>
                    <div>
                        <small class="text-muted d-block">الاختبارات</small>
                        <div class="fw-bold fs-5">{{ $examsCount ?? 0 }}</div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card p-3 shadow-sm rounded bg-white h-100 reveal d-flex align-items-center">
                    <div class="icon-box bg-success text-white p-2 rounded me-3"><i class="bi bi-graph-up fs-4"></i></div>
                    <div>
                        <small class="text-muted d-block">المعدل</small>
                        <div class="fw-bold fs-5">85%</div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="stat-card p-3 shadow-sm rounded bg-white h-100 reveal d-flex align-items-center">
                    <div class="icon-box bg-warning text-dark p-2 rounded me-3"><i class="bi bi-clock fs-4"></i></div>
                    <div>
                        <small class="text-muted d-block">ساعات الدراسة</small>
                        <div class="fw-bold fs-5">12</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 my-4">
            <div class="col-12 col-md-6">
                <a href="{{ route('student.subjects') }}" class="card text-white bg-primary shadow-sm" style="text-decoration: none;">
    <div class="card-body text-center py-4">
        <i class="bi bi-play-circle fs-1 mb-2"></i>
        <h4 class="fw-bold">ابدأ اختباراً جديداً</h4>
        <p class="small mb-0">اختر المادة ثم ابدأ الاختبار فوراً</p>
    </div>
</a>
            </div>

            <div class="col-12 col-md-6">
                <a href="{{ route('student.results') }}" class="text-decoration-none d-block h-100">
                    <div class="result-card p-4 rounded bg-white border shadow-sm reveal h-100">
                        <i class="bi bi-trophy fs-1 text-warning"></i>
                        <h3 class="fw-bold mt-2">عرض النتائج</h3>
                        <p class="text-muted mb-0">راجع أداءك في الاختبارات السابقة</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="section-header mt-5 mb-4">
            <h4 class="fw-bold text-dark"><i class="bi bi-lightning-charge text-warning me-2"></i>أحدث الاختبارات المتاحة</h4>
        </div>

        <div class="recent-exams-card bg-white rounded shadow-sm overflow-hidden mb-5">
            @forelse($latestExams as $exam)
            <div class="exam-row p-3 d-flex justify-content-between align-items-center border-bottom reveal">
                <div class="exam-info d-flex align-items-center">
                    <div class="exam-icon bg-light text-primary p-2 rounded me-3">
                        <i class="bi bi-journal-text fs-4"></i>
                    </div>
                    <div class="exam-text">
                        <div class="exam-title fw-bold text-dark fs-6">{{ $exam->title }}</div>
                        <div class="exam-subtitle small text-muted">
                            {{ $exam->subject->name ?? 'مادة عامة' }} | 
                            <span class="text-primary">{{ $exam->questions_count }} سؤال</span>
                        </div>
                    </div>
                </div>
                <div class="exam-action text-end">
                    {{-- السطر المعدل رقم 133 --}}
<a href="{{ route('student.quiz', ['unit_id' => $exam->unit_id]) }}" class="btn btn-primary">ابدأ الآن</a>
                    <div class="small text-muted mt-1" style="font-size: 0.75rem;">{{ $exam->created_at->format('Y/m/d') }}</div>
                </div>
            </div>
            @empty
            <div class="p-5 text-center text-muted">
                <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                <p>لا توجد اختبارات متاحة حالياً لصفك الدراسي.</p>
            </div>
            @endforelse
        </div>
    </div>
@endsection