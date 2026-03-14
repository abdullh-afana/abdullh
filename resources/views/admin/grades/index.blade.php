@extends('layouts.admin')

@section('title', 'إدارة الصفوف')

@section('body-class', 'page-admin-grades')

@section('content')

    <header class="page-header">
        <div>
        <div class="page-title-row">
            <h4 class="mb-1">إدارة الصفوف</h4>
            <span class="page-tag">لوحة الإدارة</span>
        </div>
        <p class="text-muted mb-0">مرحباً بك في لوحة إدارة منصة بنوك الأسئلة</p>
        <nav class="breadcrumb-lite" aria-label="مسار الصفحة">
            <span>لوحة التحكم</span>
            <i class="bi bi-chevron-left"></i>
            <span>إدارة الصفوف</span>
        </nav>


        </div>
        <button class="btn mobile-menu-btn d-lg-none" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
        <i class="bi bi-list"></i> القائمة
        </button>
    </header>


    <section class="header-actions">
        <div>
        <h5 class="mb-1">إدارة الصفوف</h5>
        <p class="text-muted mb-0">إدارة جميع الصفوف الدراسية من الصف الأول إلى الثاني عشر</p>
        </div>
        <button class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addGradeModal">
        <i class="bi bi-plus-lg"></i> إضافة صف جديد
        </button>
    </section>

    <section class="grades-grid">
        @foreach($grades as $grade)
            <div class="grade-card reveal">
                <div class="card-actions">
                    {{-- نموذج الحذف --}}
                    <form action="{{ route('admin.grades.destroy', $grade->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="icon-btn delete" type="submit" onclick="return confirm('هل أنت متأكد من حذف هذا الصف وكل ما يتعلق به؟')" aria-label="حذف">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </form>

                    {{-- زر التعديل --}}
                    <button class="icon-btn edit" type="button" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editGradeModal{{ $grade->id }}"
                            data-id="{{ $grade->id }}" 
                            data-name="{{ $grade->name }}"
                            aria-label="تعديل">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                </div>
                
                <div class="card-icon"><i class="bi bi-book"></i></div>
                
                <h6>{{ $grade->name }}</h6>
                
                @if($grade->stage == 'primary')
                    <span class="pill">أساسي</span>
                @elseif($grade->stage == 'middle')
                    <span class="pill middle">إعدادي</span>
                @elseif($grade->stage == 'high')
                    <span class="pill alt">ثانوي</span>
                @endif
                                
                <div class="card-footer">
                    {{-- عرض عدد الطلاب وعدد المواد ديناميكياً --}}
                    <div><i class="bi bi-people"></i> {{ $grade->students_count }} طالب</div>
                    <div><i class="bi bi-journal-text"></i> {{ $grade->subjects_count }} مواد</div>
                </div>
            </div>
        @endforeach
    </section>

    <!-- Modals -->
    <div class="modal fade" id="addGradeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة صف جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.grades.store') }}" method="POST" class="grade-form">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">اسم الصف</label>
                            <input type="text" name="name" class="form-control" placeholder="مثال: الصف السادس" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">الرابط المختصر (Slug)</label>
                            <input type="text" name="slug" class="form-control" placeholder="مثال: grade-6" required>
                            <small class="text-muted">بالإنجليزية فقط وبدون مسافات (استخدم الشرطة -)</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">المرحلة</label>
                            <select class="form-select" name="stage" required>
                                <option value="primary">أساسي</option>
                                <option value="middle">إعدادي</option>
                                <option value="high">ثانوي</option>
                            </select>
                        </div>

                        <div class="form-hint text-info">
                            سيتم إنشاء الصف ويمكنك إضافة الطلاب والمواد لاحقًا.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">حفظ الصف</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Edit -->
    <div class="modal fade" id="editGradeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعديل الصف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editGradeForm" method="POST" class="grade-form">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">اسم الصف</label>
                            <input type="text" name="name" id="edit_grade_name" class="form-control" placeholder="مثال: الصف السادس" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">المرحلة</label>
                            <select class="form-select" name="stage" id="edit_grade_stage">
                                <option value="أساسي">أساسي</option>
                                <option value="إعدادي">إعدادي</option>
                                <option value="ثانوي">ثانوي</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">حفظ التعديلات</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
