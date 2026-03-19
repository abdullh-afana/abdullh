<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - منصة بنوك الأسئلة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body.page-login { background: #f4f7fe; font-family: 'Segoe UI', sans-serif; height: 100vh; display: flex; align-items: center; justify-content: center; flex-direction: column; }
        .auth-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); max-width: 420px; padding: 40px; background: white; }
        .logo-icon img { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 4px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 20px; }
        /* تصميم المحول الخاص بصديقك */
        .role-switcher { display: flex; background: #f1f2f6; padding: 5px; border-radius: 12px; margin-bottom: 25px; position: relative; }
        .role-switcher input { display: none; }
        .role-switcher label { flex: 1; text-align: center; padding: 10px; cursor: pointer; border-radius: 10px; transition: 0.3s; font-weight: 600; color: #747d8c; z-index: 1; }
        .role-switcher input:checked + label { background: white; color: #6366f1; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .btn-gradient { background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); color: white; border: none; padding: 12px; border-radius: 12px; font-weight: 600; width: 100%; transition: 0.2s; }
        .form-control { padding: 12px 15px; border-radius: 12px; border: 1px solid #eee; background: #f9f9f9; }
        .input-icon-wrapper { position: relative; }
        .input-icon-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #aaa; }
    </style>
</head>
<body class="page-login">
    <div class="logo-icon"><img src="{{ asset('img/logo.jpg') }}" alt="الشعار"></div>
    <div class="card auth-card w-100">
        <h2 class="fw-bold text-center mb-1">تسجيل الدخول</h2>
        <p class="text-muted text-center mb-4 small">مرحباً بك، قم بتسجيل الدخول للمتابعة</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="role-switcher">
                <input type="radio" id="student" name="role" value="student" checked>
                <label for="student">طالب <i class="bi bi-person"></i></label>
                <input type="radio" id="admin" name="role" value="admin">
                <label for="admin">أدمن <i class="fa-solid fa-user-tie"></i></label>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">البريد الإلكتروني</label>
                <div class="input-icon-wrapper">
                    <input type="email" name="email" class="form-control" placeholder="example@email.com" value="{{ old('email') }}" required autofocus>
                    <i class="bi bi-envelope"></i>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold">كلمة المرور</label>
                <div class="input-icon-wrapper">
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    <i class="bi bi-shield-lock"></i>
                </div>
            </div>

            <button type="submit" class="btn btn-gradient shadow-sm">دخول للمنصة</button>
        </form>

        <div class="text-center mt-4">
            <p class="mb-0 small text-muted">ليس لديك حساب؟ <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">إنشاء حساب</a></p>
        </div>
    </div>
</body>
</html>