@extends('layouts.student')

@section('title', 'نتيجة الاختبار')

@section('body-class', 'page-results')

@section('content')
  <nav class="navbar student-header px-4 py-3">
    <div class="header-simple">
      <a class="brand-wrap text-decoration-none text-dark d-flex align-items-center gap-2" href="{{ url('/') }}">
        <img src="{{ asset('img/logo.jpg') }}" class="img-fluid" height="44" width="44" alt="الشعار">
        <strong class="text-primary brand-title">منصة بنوك الأسئلة</strong>
      </a>
      <a href="{{ route('student.dashboard') }}" class="back-link-inline text-decoration-none text-dark d-flex align-items-center gap-2">
        <span>الرئيسية</span><i class="bi bi-house"></i>
      </a>
      <div class="header-spacer" aria-hidden="true"></div>
    </div>
  </nav>


  <main class="results-wrapper">
    <div class="container">
      <section class="result-hero text-center">
        <div class="trophy">
          <i class="bi bi-trophy-fill"></i>
        </div>
        <h2 class="fw-bold mt-3">تم إكمال الاختبار</h2>
        <p class="text-muted mb-0">أحسنت! هذه نتائجك</p>
      </section>

      <div class="row g-4 align-items-stretch">
        <div class="col-lg-5">
          <div class="result-card reveal h-100 text-center">
            <h6 class="section-title">مراجعة الأسئلة</h6>
            <div class="score-ring" style="--value: 84;">
              <div class="score-inner">
                <div class="score-value">84%</div>
                <span class="score-label">النسبة</span>
              </div>
            </div>
            <div class="score-meta">
              <span><i class="bi bi-check-circle"></i> : 21</span>
              <span><i class="bi bi-x-circle"></i> : 4</span>
            </div>
          </div>
        </div>

        <div class="col-lg-7">
          <div class="result-card reveal h-100">
            <h6 class="section-title">مراجعة الأسئلة</h6>
            <div class="stat-item">
              <div class="stat-title">الوقت المستغرق</div>
              <div class="stat-bar">
                <div class="stat-fill primary" style="width: 85%;"></div>
              </div>
              <div class="stat-value">85%</div>
            </div>
            <div class="stat-item">
              <div class="stat-title">الوقت المستغرق</div>
              <div class="stat-bar">
                <div class="stat-fill success" style="width: 72%;"></div>
              </div>
              <div class="stat-value">21/25</div>
            </div>
            <div class="stat-item">
              <div class="stat-title">الوقت المستغرق</div>
              <div class="stat-bar">
                <div class="stat-fill danger" style="width: 28%;"></div>
              </div>
              <div class="stat-value">4/25</div>
            </div>
            <div class="stat-item mb-0">
              <div class="stat-title">الوقت المستغرق</div>
              <div class="stat-bar">
                <div class="stat-fill purple" style="width: 65%;"></div>
              </div>
              <div class="stat-value">26:35</div>
            </div>
          </div>
        </div>
      </div>

      <section class="review-card reveal mt-4">
        <h6 class="section-title">مراجعة الأسئلة</h6>
        <div class="review-list">
          <div class="review-item reveal correct">
            <span>سؤال 1: ناتج 5 + 3</span>
            <span class="badge">صحيح</span>
          </div>
          <div class="review-item reveal correct">
            <span>سؤال 2: مجموع 4 + 6</span>
            <span class="badge">صحيح</span>
          </div>
          <div class="review-item reveal correct">
            <span>سؤال 3: 7 × 3</span>
            <span class="badge">صحيح</span>
          </div>
          <div class="review-item reveal wrong">
            <span>سؤال 4: الفرق بين 9 و7</span>
            <span class="badge">صحيح</span>
          </div>
          <div class="review-item reveal correct">
            <span>سؤال 5: ناتج 8 + 2</span>
            <span class="badge">صحيح</span>
          </div>
        </div>

        <div class="review-actions">
          <a href="{{ route('student.quiz') }}" class="btn btn-outline-primary px-5 py-3 rounded-pill fw-bold">
    <i class="bi bi-arrow-clockwise"></i> إعادة المحاولة
</a>
          <a href="{{ route('student.dashboard') }}" class="btn btn-primary">العودة للرئيسية</a>
        </div>
      </section>
    </div>
  </main>
@endsection