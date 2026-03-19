@extends('layouts.admin')

@section('title', 'نتائج الطلاب')
@section('body-class', 'page-admin-results')

@section('content')
    {{-- هيدر الصفحة بتصميم صديقك --}}
    <header class="page-header">
        <div>
            <div class="page-title-row">
                <h4 class="mb-1">النتائج</h4>
                <span class="page-tag">لوحة الإدارة</span>
            </div>
            <p class="text-muted mb-0">ملخص عام لنتائج الطلاب ومؤشرات الأداء في المنصة</p>
            <nav class="breadcrumb-lite" aria-label="مسار الصفحة">
                <span>لوحة التحكم</span>
                <i class="bi bi-chevron-left"></i>
                <span>النتائج</span>
            </nav>
        </div>
        <button class="btn mobile-menu-btn d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
            <i class="bi bi-list"></i> القائمة
        </button>
    </header>

    {{-- قسم الإحصائيات - بيانات حقيقية من قاعدة بياناتك --}}
    <section class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="bi bi-people"></i></div>
            <div class="stat-meta">إجمالي المحاولات</div>
            <div class="stat-value">{{ $results->total() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple"><i class="bi bi-clipboard-data"></i></div>
            <div class="stat-meta">متوسط الدرجات</div>
            <div class="stat-value">{{ number_format($results->avg('score'), 1) }}%</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-check2-circle"></i></div>
            <div class="stat-meta">نسبة النجاح (أعلى من 50%)</div>
            <div class="stat-value">{{ number_format(($results->where('score', '>=', 50)->count() / max($results->count(), 1)) * 100, 1) }}%</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange"><i class="bi bi-exclamation-circle"></i></div>
            <div class="stat-meta">يحتاجون تحسين</div>
            <div class="stat-value">{{ $results->where('score', '<', 50)->count() }}</div>
        </div>
    </section>

    {{-- قسم الفلاتر --}}
    <section class="filters-card mt-4">
        <div class="filters-title">تصفية النتائج</div>
        <form action="" method="GET" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">بحث باسم الطالب</label>
                <input type="text" name="search" class="form-control" placeholder="اكتب اسم الطالب..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">المادة</label>
                <select name="subject" class="form-select">
                    <option value="">الكل</option>
                    {{-- هنا يمكنك عمل لووب للمواد المتوفرة --}}
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">تطبيق التصفية</button>
            </div>
        </form>
    </section>

    {{-- عرض النتائج في جدول منظّم --}}
    <section class="card-box mt-4">
        <div class="card-head mb-3">
            <div class="card-title">قائمة نتائج الطلاب الأخيرة</div>
            <span class="hint">مبنية على آخر التحديثات</span>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>الطالب</th>
                        <th>المادة / الوحدة</th>
                        <th>الأسئلة الصحيحة</th>
                        <th>الدرجة النهائية</th>
                        <th>تاريخ المحاولة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $res)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm-circle me-2">
                                    <i class="bi bi-person-circle fs-5"></i>
                                </div>
                                <span class="fw-bold">{{ $res->user->name ?? 'طالب غير معروف' }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge-soft info">{{ $res->unit->subject->name ?? 'مادة' }}</span>
                            <div class="small text-muted mt-1">{{ $res->unit->name ?? 'وحدة' }}</div>
                        </td>
                        <td>
                            <span class="text-success fw-bold">{{ $res->correct_answer }}</span> 
                            <span class="text-muted small">/ {{ $res->total_question }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="fw-bold {{ $res->score >= 50 ? 'text-success' : 'text-danger' }}">
                                    %{{ number_format($res->score, 1) }}
                                </div>
                                @if($res->score >= 85)
                                    <span class="badge-soft success small">ممتاز</span>
                                @elseif($res->score >= 50)
                                    <span class="badge-soft warning small">ناجح</span>
                                @else
                                    <span class="badge-soft danger small">راسب</span>
                                @endif
                            </div>
                        </td>
                        <td class="small text-muted">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $res->created_at->format('Y-m-d') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">لا توجد نتائج لعرضها حالياً.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        
    </section>
@endsection

{{-- إضافة بعض التنسيقات التجميلية للدمج --}}
<style>
    .avatar-sm-circle {
        width: 35px;
        height: 35px;
        background: #f0f2f5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
    }
    .badge-soft {
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    .badge-soft.success { background: #dcfce7; color: #15803d; }
    .badge-soft.warning { background: #fef9c3; color: #a16207; }
    .badge-soft.danger { background: #fee2e2; color: #b91c1c; }
    .badge-soft.info { background: #e0f2fe; color: #0369a1; }
    .table-responsive { border-radius: 12px; }
</style>