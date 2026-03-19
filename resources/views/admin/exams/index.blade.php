@extends('layouts.admin')

@section('title', 'إدارة الاختبارات')

@section('body-class', 'page-admin-exams')

@section('content')
    <header class="page-header">
        <div>
            <div class="page-title-row">
                <h4 class="mb-1">إدارة الاختبارات</h4>
                <span class="page-tag">لوحة الإدارة</span>
            </div>
            <p class="text-muted mb-0">مرحباً بك في لوحة إدارة منصة بنوك الأسئلة</p>
            <nav class="breadcrumb-lite" aria-label="مسار الصفحة">
                <span>لوحة التحكم</span>
                <i class="bi bi-chevron-left"></i>
                <span>إدارة الاختبارات</span>
            </nav>
        </div>
        <button class="btn mobile-menu-btn d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
            <i class="bi bi-list"></i> القائمة
        </button>
    </header>

    <section class="header-actions">
        <div>
            <h5 class="mb-1">إدارة الاختبارات</h5>
            <p class="text-muted mb-0">إنشاء وإدارة الاختبارات مع نظام الاختبار العشوائي للأسئلة</p>
        </div>
        <a href="{{ route('admin.exams.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> إنشاء اختبار جديد
        </a>
    </section>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    @forelse($exams as $exam)
    <section class="exam-card reveal mb-4 shadow-sm p-3 bg-white rounded">
        <div class="exam-head">
           
            <div class="exam-title">
                <div class="exam-icon doc"><i class="bi bi-file-earmark-text"></i></div>
                <div>
                    <h6 class="exam-name">{{ $exam->title }}</h6>
                    <div class="exam-meta">
                        <span><i class="bi bi-bookmark"></i> {{ $exam->subject->grade->name ?? 'الصف العاشر' }}</span>
                        <span><i class="bi bi-book"></i> {{ $exam->subject->name ?? 'اللغة العربية' }}</span>
                        <span><i class="bi bi-calendar3"></i> {{ $exam->created_at->format('Y/m/d') }}</span>
                    </div>
                </div>
            </div>
            <div class="exam-units">
                <div class="unit-label">توزيع الدرجات:</div>
                <span class="pill bg-light text-primary">{{ $exam->total_mark ?? 100 }} درجة</span>
            </div>
        </div>

        <div class="exam-stats">
            <div class="stat-box">
                <div class="stat-label"><i class="bi bi-question-circle"></i> عدد الأسئلة</div>
                {{ $exam->questions_count }} أسئلة
            </div>
            <div class="stat-box">
                <div class="stat-label"><i class="bi bi-clock"></i> المدة</div>
                <strong>{{ $exam->duration }} دقيقة</strong>
            </div>
            <div class="stat-box">
                <div class="stat-label"><i class="bi bi-magic"></i> النوع</div>
                <strong>عشوائي</strong>
            </div>
        </div>

        <div class="exam-actions mt-3 pt-3 border-top">
            <a href="{{ route('admin.exams.show', $exam->id) }}" class="btn btn-action view">
                <i class="bi bi-eye"></i> معاينة الأسئلة
            </a>
            
            <a href="{{ route('admin.exams.edit', $exam->id) }}" class="btn btn-action edit">
                <i class="bi bi-pencil-square"></i> تعديل
            </a>

            <form action="{{ route('admin.exams.destroy', $exam->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا الاختبار نهائياً؟')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-action delete">
                    <i class="bi bi-trash3"></i> حذف
                </button>
            </form>
        </div>
    </section>
    @empty
        <div class="text-center py-5 bg-white rounded shadow-sm">
            <i class="bi bi-clipboard-x display-1 text-muted"></i>
            <h5 class="mt-3">لا يوجد اختبارات حالياً</h5>
            <p class="text-muted">ابدأ الآن بإنشاء أول اختبار وتوليد أسئلته عشوائياً</p>
            <a href="{{ route('admin.exams.create') }}" class="btn btn-primary mt-2">
                أنشئ أول اختبار الآن
            </a>
        </div>
    @endforelse

@endsection