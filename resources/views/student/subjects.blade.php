<x-guest-layout>
{{-- استدعاء ملفات الـ CSS --}}

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<body class="page-subject">
    {{-- هيدر صديقك الموحد --}}
    <nav class="navbar student-header px-4 py-3 shadow-sm bg-white">
        <div class="header-simple d-flex justify-content-between w-100 align-items-center">
            <a class="brand-wrap text-decoration-none text-dark d-flex align-items-center gap-2" href="{{ route('student.dashboard') }}">
                <img src="{{ asset('img/logo.jpg') }}" class="img-fluid" height="44" width="44" alt="الشعار">
                <strong class="text-primary brand-title" style="font-family: 'Noto Kufi Arabic';">منصة بنوك الأسئلة</strong>
            </a>
            <a href="{{ route('student.dashboard') }}" class="back-link-inline text-decoration-none text-dark d-flex align-items-center gap-2">
                <span>رجوع</span><i class="bi bi-arrow-left"></i>
            </a>
        </div>
    </nav>

    <div class="container py-5">
        {{-- قسم العنوان من تصميم صديقك --}}
        <div class="text-center mb-5">
            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3 d-inline-block">
                {{ auth()->user()->grade->name ?? 'الصف الدراسي' }}
            </span>
            <h2 class="fw-bold" style="font-family: 'Noto Kufi Arabic';">اختر المادة الدراسية</h2>
            <p class="text-muted">انقر على المادة لعرض الوحدات المتاحة للاختبار</p>
        </div>

        <div class="row g-4 justify-content-center">
            @foreach($subjects as $subject)
                <div class="col-lg-4 col-md-6">
                    {{-- استخدمنا كلاس subject-card من تصميم صديقك --}}
                    <div class="subject-card reveal h-100 shadow-sm border-0">
                        
                        {{-- منطق اختيار الأيقونة واللون بناءً على اسم المادة --}}
                        @php
                            $iconClass = 'fa-solid fa-book-open'; // افتراضي
                            $cornerClass = 'card-corner-ar';     // افتراضي
                            $innerIcon = 'icon-ar';             // افتراضي

                            if(str_contains($subject->name, 'رياضيات')) {
                                $iconClass = 'bi bi-calculator';
                                $cornerClass = 'card-corner-math';
                                $innerIcon = 'icon-math';
                            } elseif(str_contains($subject->name, 'علوم')) {
                                $iconClass = 'fa-solid fa-flask';
                                $cornerClass = 'card-corner-science';
                                $innerIcon = 'icon-science';
                            } elseif(str_contains($subject->name, 'إنجليزي') || str_contains($subject->name, 'English')) {
                                $iconClass = 'bi bi-translate';
                                $cornerClass = 'card-corner-en';
                                $innerIcon = 'icon-en';
                            }
                        @endphp

                        <div class="{{ $cornerClass }}">
                            <div class="icon-box {{ $innerIcon }}">
                                <i class="{{ $iconClass }}"></i>
                            </div>
                        </div>

                        <h5 class="subject-title mt-4 fw-bold">{{ $subject->name }}</h5>
                        
                        {{-- رابط الانتقال للوحدات مع زر صديقك --}}
                        <a href="{{ route('student.units', $subject->id) }}" class="start-btn d-flex align-items-center gap-2 text-decoration-none mt-auto">
                            <span>حدد الوحدة</span>
                            <i class="bi bi-arrow-left"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</x-guest-layout>