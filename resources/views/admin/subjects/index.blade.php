@extends('layouts.admin')

@section('title', 'إدارة المواد')

{{-- الكلاس ضروري عشان التنسيق يشتغل صح --}}
@section('body-class', 'page-admin-subjects')

@section('content')
    <header class="page-header">
    <div>
        <div class="page-title-row">
        <h4 class="mb-1">إدارة المواد</h4>
        <span class="page-tag">لوحة الإدارة</span>
        </div>
        <p class="text-muted mb-0">مرحباً بك في لوحة إدارة منصة بنوك الأسئلة</p>
        <nav class="breadcrumb-lite" aria-label="مسار الصفحة">
        <span>لوحة التحكم</span>
        <i class="bi bi-chevron-left"></i>
        <span>إدارة المواد</span>
        </nav>


    </div>
    <button class="btn mobile-menu-btn d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
        <i class="bi bi-list"></i> القائمة
    </button>
    </header>

    <section class="header-actions">
    <div>
        <h5 class="mb-1">إدارة المواد الدراسية</h5>
        <p class="text-muted mb-0">إضافة وإدارة المواد الدراسية وربطها بالصفوف المختلفة</p>
    </div>
    <button class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
        <i class="bi bi-plus-lg"></i> إضافة مادة جديدة
    </button>
    </section>

<section class="subjects-grid">
    @foreach($subjects as $subject)
        <div class="subject-card reveal">
            <div class="card-actions">
                {{-- زر الحذف --}}
                <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button class="icon-btn delete" type="submit" onclick="return confirm('هل أنت متأكد من الحذف؟')" aria-label="حذف">
                        <i class="bi bi-trash3"></i>
                    </button>
                </form>

                {{-- زر التعديل --}}
                <button class="icon-btn edit" type="button" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editSubjectModal" 
                        data-id="{{ $subject->id }}" 
                        data-name="{{ $subject->name }}"
                        aria-label="تعديل">
                    <i class="bi bi-pencil-square"></i>
                </button>
            </div>

            {{-- أيقونة المادة - يمكنك تغيير اللون بناءً على الـ ID أو نوع المادة --}}
            <div class="card-icon purple"><i class="bi bi-book"></i></div>
            
            <h6>{{ $subject->name }}</h6>
            <span class="pill">{{ $subject->grade->name ?? 'غير محدد' }}</span>
            
            <div class="card-footer">
                {{-- عرض عدد الوحدات والأسئلة بشكل ديناميكي --}}
                <div><i class="bi bi-collection"></i> {{ $subject->units_count ?? 0 }} الوحدات</div>
            </div>
        </div>
    @endforeach
</section>


<!-- Modals -->
<div class="modal fade" id="addSubjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">إضافة مادة جديدة</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <form action="{{ route('admin.subjects.store') }}" method="POST" class="subject-form">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">اسم المادة</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">الصف</label>
                    <select name="grade_id" class="form-select">
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                <button type="submit" class="btn btn-primary">حفظ المادة</button>
            </div>            
        </form>

    </div>
    </div>
</div>

<div class="modal fade" id="editSubjectModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">تعديل المادة</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form class="subject-form">
            <div class="mb-3">
            <label class="form-label">اسم المادة</label>
            <input type="text" class="form-control" placeholder="مثال: الرياضيات">
            </div>
            <div class="mb-3">
            <label class="form-label">الصف</label>
            <select class="form-select">
                <option>الصف التاسع</option>
                <option>الصف العاشر</option>
                <option>الصف الحادي عشر</option>
                <option>الصف الثاني عشر</option>
            </select>
            </div>
            <button class="btn add-btn w-100" type="button">حفظ التعديلات</button>
        </form>
        </div>
    </div>
    </div>
</div>
@endsection