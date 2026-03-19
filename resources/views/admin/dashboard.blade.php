@extends('layouts.admin')

@section('title', 'لوحة الإدارة')
@section('body-class', 'page-admin-dashboard')

@section('content')
    {{-- رأس الصفحة --}}
    <header class="page-header">
        <div>
            <div class="page-title-row">
                <h4 class="mb-1">لوحة الإدارة</h4>
                <span class="page-tag">لوحة الإدارة</span>
            </div>
            <p class="text-muted mb-0">مرحباً بك في لوحة إدارة منصة بنوك الأسئلة</p>
            <nav class="breadcrumb-lite" aria-label="مسار الصفحة">
                <span>لوحة التحكم</span>
                <i class="bi bi-chevron-left"></i>
                <span>لوحة الإدارة</span>
            </nav>
        </div>
        <button class="btn mobile-menu-btn d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
            <i class="bi bi-list"></i> القائمة
        </button>
    </header>

    {{-- شبكة الإحصائيات - بيانات حقيقية بتنسيق صديقك --}}
    <section class="stats-grid">
        <div class="stat-card reveal">
            <div class="stat-icon purple"><i class="bi bi-people"></i></div>
            <div class="stat-meta">عدد الطلاب</div>
            <div class="stat-value">{{ number_format($stats['students_count']) }}</div>
            <div class="stat-change up">+100%</div>
        </div>
        <div class="stat-card reveal">
            <div class="stat-icon teal"><i class="bi bi-book-half"></i></div>
            <div class="stat-meta">عدد المواد</div>
            <div class="stat-value">{{ $stats['subjects_count'] }}</div>
        </div>
        <div class="stat-card reveal">
            <div class="stat-icon orange"><i class="bi bi-clipboard-data"></i></div>
            <div class="stat-meta">عدد الاختبارات</div>
            <div class="stat-value">{{ $stats['exams_count'] }}</div>
        </div>
        <div class="stat-card reveal">
            <div class="stat-icon blue"><i class="bi bi-question-circle"></i></div>
            <div class="stat-meta">عدد الأسئلة</div>
            <div class="stat-value">{{ number_format($stats['questions_count']) }}</div>
        </div>
    </section>

    <section class="row g-3">
        {{-- قسم أحدث الاختبارات --}}
        <div class="col-lg-8 order-lg-1">
            <div class="card-box reveal">
                <div class="card-head">
                    <div class="card-title">أحدث الاختبارات</div>
                    <a class="view-all" href="{{ route('admin.exams.index') }}">عرض الكل</a>
                </div>
                <div class="test-list">
                    @foreach($latestExams as $exam)
                    <div class="test-item reveal">
                        <div class="test-content w-100">
                            <div class="test-head d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="mb-1">{{ $exam->title }}</h6>
                                    <div class="test-meta-line">
                                        <span class="badge bg-light text-dark border">{{ $exam->subject->name ?? 'مادة غير محددة' }}</span>
                                        <span class="text-muted small ms-2">{{ $exam->subject->grade->name ?? '' }}</span>
                                    </div>
                                </div>
                                <span class="status-pill {{ $exam->questions_count > 0 ? 'active' : 'done' }}">
                                    {{ $exam->questions_count > 0 ? 'نشط' : 'فارغ' }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div class="test-date small text-muted">
                                        <span>عدد الأسئلة: {{ $exam->questions_count }} أسئلة</span>
                                    <span><i class="bi bi-clock"></i> {{ $exam->created_at->format('Y/m/d') }}</span>
                                </div>
                                <a href="{{ route('admin.exams.show', $exam->id) }}" class="btn btn-sm btn-outline-primary py-0">
                                    <i class="bi bi-eye"></i> معاينة
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- قسم أحدث المواد --}}
        <div class="col-lg-4 order-lg-2">
            <div class="card-box reveal">
                <div class="card-head">
                    <div class="card-title">أحدث المواد</div>
                    <a class="view-all" href="{{ route('admin.subjects.index') }}">عرض الكل</a>
                </div>
                <div class="subject-list">
                    @foreach($latestSubjects as $subject)
                    <div class="subject-item reveal d-flex align-items-center">
                        <div class="subject-icon blue"><i class="bi bi-book"></i></div>
                        <div class="subject-content">
                            <h6>{{ $subject->name }}</h6>
                            <small>{{ $subject->grade->name ?? 'غير محدد' }}</small>
                            <div class="subject-meta">
                                <span>{{ $subject->units->count() }} وحدات</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- نشاط النظام --}}
    <section class="card-box mt-3 reveal">
        <div class="card-title">نشاط النظام</div>
        
        @if($lastSubject)
        <div class="activity-row reveal">
            <span class="activity-dot blue"><i class="bi bi-journal-plus"></i></span>
            <div>
                <h6>تمت إضافة مادة جديدة: {{ $lastSubject->name }}</h6>
                <small>{{ $lastSubject->created_at->diffForHumans() }}</small>
            </div>
        </div>
        @endif

        @if($lastExam)
        <div class="activity-row reveal">
            <span class="activity-dot green"><i class="bi bi-clipboard-check"></i></span>
            <div>
                <h6>تم إنشاء اختبار جديد: {{ $lastExam->title }}</h6>
                <small>{{ $lastExam->created_at->diffForHumans() }}</small>
            </div>
        </div>
        @endif

        @if($lastQuestion)
        <div class="activity-row reveal">
            <span class="activity-dot teal"><i class="bi bi-question-circle"></i></span>
            <div>
                <h6>تمت إضافة أسئلة لـ {{ $lastQuestion->unit->name ?? 'البنك' }}</h6>
                <small>{{ $lastQuestion->created_at->diffForHumans() }}</small>
            </div>
        </div>
        @endif
    </section>
@endsection