<x-guest-layout>
<body class="page-student-profile">
    <nav class="navbar student-header px-4 py-3">
        <div class="header-simple d-flex justify-content-between w-100">
            <a class="brand-wrap text-decoration-none text-dark d-flex align-items-center gap-2" href="{{ route('student.dashboard') }}">
                <img src="{{ asset('img/logo.jpg') }}" class="img-fluid" height="44" width="44" alt="الشعار">
                <strong class="text-primary brand-title">منصة بنوك الأسئلة</strong>
            </a>
            <a href="{{ route('student.dashboard') }}" class="back-link-inline text-decoration-none text-dark d-flex align-items-center gap-2">
                <span>رجوع</span><i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="profile-card p-4 p-md-5 bg-white shadow-sm rounded">
            <div class="text-center mb-4">
                <div class="profile-avatar mx-auto mb-3 bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                    <i class="bi bi-person fs-1 text-primary"></i>
                </div>
                <h2 class="fw-bold mb-1">الملف الشخصي</h2>
                <p class="text-muted mb-0">حدّث بياناتك والصف الدراسي</p>
            </div>

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success mt-4">تم حفظ البيانات بنجاح.</div>
            @endif

            <form method="post" action="{{ route('profile.update') }}" class="row g-3">
                @csrf
                @method('patch')

                <div class="col-12 col-md-6">
                    <label class="form-label">الاسم الكامل</label>
                    <input name="name" type="text" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input name="email" type="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">الصف الدراسي</label>
                    <select name="grade_id" class="form-select" required>
                        <option value="" disabled>اختر الصف</option>
                        @foreach(\App\Models\Grade::all() as $grade)
                            <option value="{{ $grade->id }}" {{ auth()->user()->grade_id == $grade->id ? 'selected' : '' }}>
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label">كلمة المرور (اختياري)</label>
                    <input name="password" type="password" class="form-control" placeholder="كلمة مرور جديدة">
                </div>

                <div class="col-12">
                    <button class="btn btn-primary w-100 py-2" type="submit">حفظ التغييرات</button>
                </div>
            </form>
        </div>
    </div>
</body>
</x-guest-layout>