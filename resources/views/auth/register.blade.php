<x-guest-layout>
<body class="page-signup">
    <div class="logo-box">
        <div class="logo-icon">
            <img src="{{ asset('img/logo.jpg') }}" alt="الشعار">
        </div>
    </div>

    <div class="container d-flex justify-content-center">
        <div class="card auth-card p-4 w-100 reveal">
            <h2 class="fw-bold text-center mb-1">إنشاء حساب جديد</h2>
            <p class="text-muted text-center mb-4" style="font-weight: 300;">أدخل بياناتك لإنشاء حساب جديد</p>

            <form method="POST" action="{{ route('register') }}" class="signupForm">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">الاسم الكامل</label>
                    <div class="input-icon-wrapper">
                        <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required placeholder="مثال: أحمد محمد" />
                        <i class="bi bi-person"></i>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger small" />
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <div class="input-icon-wrapper">
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required placeholder="example@email.com" />
                        <i class="bi bi-envelope"></i>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger small" />
                </div>

                <div class="mb-3">
                    <label for="grade_id" class="form-label">الصف الدراسي</label>
                    <select id="grade_id" name="grade_id" class="form-select" required>
                        <option value="" disabled selected>اختر الصف</option>
                        @foreach(\App\Models\Grade::all() as $grade)
                            <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('grade_id')" class="mt-2 text-danger small" />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">كلمة المرور</label>
                    <div class="input-icon-wrapper">
                        <input id="password" class="form-control" type="password" name="password" required placeholder="أدخل كلمة المرور" />
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger small" />
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                    <div class="input-icon-wrapper">
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required placeholder="أعد إدخال كلمة المرور" />
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>

                <button type="submit" class="btn btn-gradient w-100">
                    تسجيل حساب جديد <i class="fas fa-user-plus ms-2"></i>
                </button>
            </form>

            <div class="text-center mt-3">
                <p class="mb-0" style="font-size: 0.95rem;">لديك حساب بالفعل؟ 
                    <a href="{{ route('login') }}" class="text-primary fw-bold">تسجيل الدخول</a>
                </p>
            </div>
        </div>
    </div>    
    <div class="back-link text-center mt-3">
        <a href="{{ url('/') }}">العودة للصفحة الرئيسية</a>
    </div>    
</body>
</x-guest-layout>