<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <body class="page-login">
        <div class="logo-box">
            <div class="logo-icon">
                <img src="{{ asset('img/logo.jpg') }}" alt="الشعار">
            </div>
        </div>
        
    <div class="container d-flex justify-content-center">
        <div class="card auth-card w-100 reveal">

            <h2 class="fw-bold text-center mb-1">تسجيل الدخول</h2>
            <p class="text-muted text-center mb-4" style="font-weight: 300;">مرحباً بك، قم بتسجيل الدخول للمتابعة</p>


            <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="email">البريد الإلكتروني</label>
                        <div class="input-icon-wrapper">
                            <input type="email" class="form-control" placeholder="example@email.com" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            <i class="bi bi-envelope"></i>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="password">كلمة المرور</label>
                        <div class="input-icon-wrapper">
                            <input type="password" class="form-control" placeholder="أدخل كلمة المرور" id="password" name="password" required>
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="block mt-4 mb-4" style="direction: rtl;">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">تذكرني</span>
                        </label>
                    </div>

                
                <center>
                <button class="btn btn-gradient">
                    تسجيل الدخول
                </button>
                </center>

            </form>

            <div class="text-center mt-3">
                <p class="mb-0" style="font-size: 0.95rem;">
                    ليس لديك حساب؟
                    <a href="{{ route('register') }}" class="text-primary fw-bold">إنشاء حساب</a>
                </p>
            </div>
        </div>
    </div>

    <div class="back-link">
        <a href="{{ url('/') }}">العودة للصفحة الرئيسية</a>
    </div>
</body>


</x-guest-layout>
