<x-guest-layout>
{{-- استدعاء ملفات الـ CSS --}}
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<body class="page-results">
    {{-- هيدر صديقك الموحد --}}
    <nav class="navbar student-header px-4 py-3 bg-white shadow-sm">
        <div class="header-simple d-flex justify-content-between w-100 align-items-center">
            <a class="brand-wrap text-decoration-none text-dark d-flex align-items-center gap-2" href="{{ route('student.dashboard') }}">
                <img src="{{ asset('img/logo.jpg') }}" class="img-fluid" height="44" width="44" alt="الشعار">
                <strong class="text-primary brand-title">منصة بنوك الأسئلة</strong>
            </a>
            <a href="{{ route('student.dashboard') }}" class="back-link-inline text-decoration-none text-dark d-flex align-items-center gap-2 fw-bold">
                <span>رجوع للرئيسية</span><i class="bi bi-arrow-left"></i>
            </a>
        </div>
    </nav>

    <main class="results-wrapper py-5">
        <div class="container">
            {{-- جلب آخر نتيجة حصراً لعرضها في الهيرو سيكشن --}}
            @php $latestResult = $results->first(); @endphp

            @if($latestResult)
                <section class="result-hero text-center mb-5">
                    <div class="trophy mb-3">
                        <i class="bi bi-trophy-fill" style="font-size: 4rem; color: #ffc107;"></i>
                    </div>
                    <h2 class="fw-bold">تم إكمال الاختبار بنجاح</h2>
                    <p class="text-muted">أحسنت يا {{ auth()->user()->name }}! إليك تفاصيل أدائك في وحدة: {{ $latestResult->unit->name }}</p>
                </section>

                <div class="row g-4 align-items-stretch mb-5">
                    {{-- كرت النسبة المئوية --}}
                    <div class="col-lg-5">
                        <div class="result-card shadow-sm border-0 h-100 text-center p-4 bg-white rounded-4">
                            <h6 class="section-title fw-bold mb-4 text-primary">النسبة المئوية</h6>
                            <div class="score-ring mx-auto mb-4" style="--value: {{ $latestResult->score }}; width: 150px; height: 150px; border-radius: 50%; background: radial-gradient(closest-side, white 79%, transparent 80% 100%), conic-gradient(#7c3aed {{ $latestResult->score }}%, #f0f0f0 0);">
                                <div class="score-inner d-flex flex-column justify-content-center h-100">
                                    <div class="score-value fs-2 fw-bold text-dark">{{ $latestResult->score }}%</div>
                                </div>
                            </div>
                            <div class="score-meta d-flex justify-content-around mt-3">
                                <span class="badge bg-success-subtle text-success p-2 px-3 rounded-pill"><i class="bi bi-check-circle me-1"></i> صح: {{ $latestResult->correct_answer }}</span>
                                <span class="badge bg-danger-subtle text-danger p-2 px-3 rounded-pill"><i class="bi bi-x-circle me-1"></i> خطأ: {{ $latestResult->total_question - $latestResult->correct_answer }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- كرت الإحصائيات الشريطية --}}
                    <div class="col-lg-7">
                        <div class="result-card shadow-sm border-0 h-100 p-4 bg-white rounded-4">
                            <h6 class="section-title fw-bold mb-4 text-primary">تفاصيل التقييم</h6>
                            
                            {{-- شريط الدرجة --}}
                            <div class="stat-item mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="stat-title fw-bold">إجمالي الإجابات الصحيحة</span>
                                    <span class="stat-value">{{ $latestResult->correct_answer }} / {{ $latestResult->total_question }}</span>
                                </div>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar bg-success" style="width: {{ ($latestResult->correct_answer / $latestResult->total_question) * 100 }}%"></div>
                                </div>
                            </div>

                            {{-- شريط الحالة --}}
                            <div class="stat-item mb-4">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="stat-title fw-bold">حالة الطالب</span>
                                    <span class="stat-value {{ $latestResult->score >= 50 ? 'text-success' : 'text-danger' }}">
                                        {{ $latestResult->score >= 50 ? 'متميز/ناجح' : 'يحتاج مراجعة' }}
                                    </span>
                                </div>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar {{ $latestResult->score >= 50 ? 'bg-primary' : 'bg-warning' }}" style="width: {{ $latestResult->score }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- جدول السجلات القديمة (دمجنا فيه تصميم الجدول الخاص بك) --}}
            <section class="history-section mt-5">
                <h5 class="fw-bold mb-4"><i class="bi bi-clock-history me-2 text-primary"></i>سجل الاختبارات السابقة</h5>
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">المادة والوحدة</th>
                                <th class="text-center">الدرجة</th>
                                <th class="text-center">النسبة</th>
                                <th class="text-center">التاريخ</th>
                                <th class="text-center pe-4">الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($results as $result)
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-bold d-block text-dark">{{ $result->unit->subject->name ?? 'مادة' }}</span>
                                        <small class="text-muted">{{ $result->unit->name }}</small>
                                    </td>
                                    <td class="text-center fw-bold">{{ $result->correct_answer }} / {{ $result->total_question }}</td>
                                    <td class="text-center text-primary fw-bold">{{ $result->score }}%</td>
                                    <td class="text-center text-muted small">{{ $result->created_at->format('Y-m-d') }}</td>
                                    <td class="text-center pe-4">
                                        <span class="badge rounded-pill {{ $result->score >= 50 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} px-3 py-2">
                                            {{ $result->score >= 50 ? 'ناجح' : 'ضعيف' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">لا توجد سجلات سابقة</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
</body>

<style>
    .result-card { transition: 0.3s ease; }
    .result-card:hover { transform: translateY(-5px); }
    .section-title { border-right: 4px solid #7c3aed; padding-right: 10px; }
    .score-ring { display: flex; align-items: center; justify-content: center; position: relative; }
</style>
</x-guest-layout>