<x-guest-layout>
{{-- تأكد أن ملف الـ CSS الخاص بصديقك موجود في public/css/app.css --}}
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<body class="page-student-profile">
    {{-- هيدر صديقك مع روابط لارافيل --}}
    <nav class="navbar student-header px-4 py-3 shadow-sm bg-white">
        <div class="header-simple d-flex justify-content-between w-100 align-items-center">
            <a class="brand-wrap text-decoration-none text-dark d-flex align-items-center gap-2" href="{{ route('student.dashboard') }}">
                <img src="{{ asset('img/logo.jpg') }}" class="img-fluid" height="44" width="44" alt="الشعار">
                <strong class="text-primary brand-title" style="font-family: 'Noto Kufi Arabic', sans-serif;">منصة بنوك الأسئلة</strong>
            </a>
            <a href="{{ route('student.dashboard') }}" class="back-link-inline text-decoration-none text-dark d-flex align-items-center gap-2 fw-bold">
                <span>رجوع</span><i class="bi bi-arrow-left"></i>
            </a>
        </div>
    </nav>

    <div class="container my-5">
        {{-- كرت الملف الشخصي بتصميم صديقك --}}
        <div class="profile-card p-4 p-md-5 bg-white shadow-lg rounded-4 border-0">
            <div class="text-center mb-4">
                {{-- أيقونة بروفايل احترافية --}}
                <div class="profile-avatar mx-auto mb-3 bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                    <i class="bi bi-person-badge fs-1 text-primary"></i>
                </div>
                <h2 class="fw-bold mb-1" style="font-family: 'Noto Kufi Arabic', sans-serif;">الملف الشخصي</h2>
                <p class="text-muted mb-0">مرحباً {{ auth()->user()->name }}، يمكنك تحديث بياناتك هنا</p>
            </div>

            {{-- رسالة النجاح --}}
            @if (session('status') === 'profile-updated')
                <div class="alert alert-success border-0 rounded-pill text-center mb-4 shadow-sm">
                    <i class="bi bi-check-circle-fill me-2"></i> تم حفظ البيانات بنجاح.
                </div>
            @endif

            {{-- الفورم الخاص بك مدمج بتصميم صديقك --}}
            <form method="post" action="{{ route('profile.update') }}" class="row g-4">
                @csrf
                @method('patch')

                {{-- الاسم الكامل --}}
                <div class="col-12 col-md-6">
                    <label class="form-label fw-bold">الاسم الكامل</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-person text-primary"></i></span>
                        <input name="name" type="text" class="form-control border-0 bg-light p-3 rounded-start" value="{{ old('name', auth()->user()->name) }}" required>
                    </div>
                </div>

                {{-- البريد الإلكتروني --}}
                <div class="col-12 col-md-6">
                    <label class="form-label fw-bold">البريد الإلكتروني</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-envelope text-primary"></i></span>
                        <input name="email" type="email" class="form-control border-0 bg-light p-3 rounded-start" value="{{ old('email', auth()->user()->email) }}" required>
                    </div>
                </div>

                {{-- الصف الدراسي (ديناميكي) --}}
                <div class="col-12 col-md-6">
                    <label class="form-label fw-bold">الصف الدراسي</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-mortarboard text-primary"></i></span>
                        <select name="grade_id" class="form-select border-0 bg-light p-3" required>
                            <option value="" disabled>اختر الصف الدراسي</option>
                            @foreach(\App\Models\Grade::all() as $grade)
                                <option value="{{ $grade->id }}" {{ auth()->user()->grade_id == $grade->id ? 'selected' : '' }}>
                                    {{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- كلمة المرور --}}
                <div class="col-12 col-md-6">
                    <label class="form-label fw-bold">كلمة المرور (اختياري)</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-lock text-primary"></i></span>
                        <input name="password" type="password" class="form-control border-0 bg-light p-3 rounded-start" placeholder="اتركها فارغة لعدم التغيير">
                    </div>
                </div>

                {{-- زر الحفظ بتصميم أزرار صديقك --}}
                <div class="col-12 mt-5">
                    <button class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm" type="submit" 
                            style="background: linear-gradient(135deg, #7c3aed, #2563eb); border: none;">
                        <i class="bi bi-save me-2"></i> حفظ التغييرات والبيانات
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</x-guest-layout>