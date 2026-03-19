<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب - منصة بنوك الأسئلة</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body.page-signup { background: #f4f7fe; font-family: 'Segoe UI', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; flex-direction: column; padding: 40px 0; }
        .auth-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); max-width: 500px; padding: 35px; background: white; }
        .logo-icon img { width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 4px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .role-option { display: flex; align-items: center; gap: 10px; padding: 12px; border: 1px solid #eee; border-radius: 12px; cursor: pointer; background: #f9f9f9; transition: 0.3s; margin-bottom: 10px; }
        .role-option input:checked + span { color: #6366f1; font-weight: bold; }
        .role-option:has(input:checked) { border-color: #6366f1; background: #f0f1ff; }
        .btn-gradient { background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%); color: white; border: none; padding: 12px; border-radius: 12px; font-weight: 600; width: 100%; }
        .form-control, .form-select { padding: 12px 15px; border-radius: 12px; border: 1px solid #eee; background: #f9f9f9; }
    </style>
</head>
<body class="page-signup">
    <div class="logo-icon"><img src="{{ asset('img/logo.jpg') }}" alt="الشعار"></div>
    <div class="card auth-card w-100 shadow-sm">
        <h2 class="fw-bold text-center mb-1">إنشاء حساب جديد</h2>
        <p class="text-muted text-center mb-4 small">أدخل بياناتك لإنشاء حساب جديد</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3 text-end">
                <label class="form-label small fw-bold">الاسم الكامل</label>
                <input type="text" name="name" class="form-control" placeholder="أحمد محمد" required>
            </div>

            <div class="mb-3 text-end">
                <label class="form-label small fw-bold">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
            </div>

            <div class="mb-3 text-end">
                <label class="form-label small fw-bold">نوع الحساب</label>
                <div class="d-grid gap-2">
                    <label class="role-option">
                        <input type="radio" name="role" value="student" checked>
                        <i class="bi bi-person-badge"></i> <span>طالب</span>
                    </label>
                    <label class="role-option">
                        <input type="radio" name="role" value="admin">
                        <i class="fa-solid fa-user-tie"></i> <span>أدمن</span>
                    </label>
                </div>
            </div>

            <div class="mb-3 text-end">
                <label class="form-label small fw-bold">الصف الدراسي</label>
                <select name="grade" class="form-select" required>
                    <option value="" disabled selected>اختر الصف</option>
                    <option value="1">الصف الأول (أساسي)</option>
                    <option value="12s">الصف الثاني عشر - علمي</option>
                    </select>
            </div>

            <div class="mb-3 text-end">
                <label class="form-label small fw-bold">كلمة المرور</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-4 text-end">
                <label class="form-label small fw-bold">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-gradient shadow-sm">إنشاء حساب</button>
        </form>

        <div class="text-center mt-3">
            <p class="mb-0 small">لديك حساب بالفعل؟ <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">تسجيل الدخول</a></p>
        </div>
    </div>
</body>
</html>