<x-app-layout>

    <section class="hero">
        <div class="container">
            <h1 class="hero-title">طور مهاراتك الدراسية <br><span>بطريقة ذكية وممتعة</span></h1>
            <p class="hero-text">منصة تعليمية تفاعلية توفر بنك أسئلة شامل للمنهاج الفلسطيني<br>من الصف الأول حتى الثاني
                عشر – العلمي والأدبي</p>
            <div class="d-flex flex-wrap justify-content-center gap-3 mt-4">
                <a href="{{ route('student.subjects') }}" id="start" class="btn">ابدأ الاختبار الآن</a>
                <a href="{{ route('register') }}" id="search" class="btn">سجل الان</a>
            </div>
        </div>
    </section>


    <section class="features py-5 section-F9F9FF">
        <div class="container text-center">
            <h2 class="fw-bold mb-2" style="font-size: 40px;">مميزات المنصة</h2>
            <p class="text-muted mb-5" style="font-size: 20px;">كل ما تحتاجه للتفوق الدراسي في مكان واحد</p>
            <div class="row g-4">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="icon">📘</div>
                        <h5 class="fw-bold">بنك أسئلة شامل</h5>
                        <p class="text-muted">مكتبة واسعة من الأسئلة لجميع الصفوف والمواد الدراسية</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="icon">🧠</div>
                        <h5 class="fw-bold">اختبارات ذاتية</h5>
                        <p class="text-muted">قيّم مستواك وتدرب على الامتحانات بطريقة تفاعلية وممتعة</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="icon">🎯</div>
                        <h5 class="fw-bold">نتائج فورية</h5>
                        <p class="text-muted">احصل على تقييم مباشر لأدائك مع تحليل مفصل للإجابات</p>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="feature-card">
                        <div class="icon">♿</div>
                        <h5 class="fw-bold">إمكانية الوصول</h5>
                        <p class="text-muted">منصة مصممة لتكون سهلة الاستخدام للجميع بما فيهم ذوي الإعاقة البصرية</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="grades py-5 section-EFF4FE">
        <div class="container text-center">
            <h2 class="fw-bold mb-2" style="font-size: 40px;">الصفوف الدراسية</h2>
            <p class="text-muted mb-5" style="font-size: 20px;">اختر صفك الدراسي وابدأ رحلة التعلم</p>
            <div class="row g-3 justify-content-center">

                <div class="col-6 col-md-4 col-lg-2">
                    <div class="grade-card"><span>الصف</span><strong>1</strong></div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="grade-card"><span>الصف</span><strong>2</strong></div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="grade-card"><span>الصف</span><strong>3</strong></div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="grade-card"><span>الصف</span><strong>4</strong></div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="grade-card"><span>الصف</span><strong>5</strong></div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="grade-card"><span>الصف</span><strong>6</strong></div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="grade-card"><span>الصف</span><strong>7</strong></div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="grade-card"><span>الصف</span><strong>8</strong></div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="grade-card"><span>الصف</span><strong>9</strong></div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="grade-card"><span>الصف</span><strong>10</strong></div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="grade-card"><span>الصف</span><strong>11</strong></div>
                </div>
                <div class="col-6 col-md-4 col-lg-2">
                    <div class="grade-card"><span>الصف</span><strong>12</strong></div>
                </div>
            </div>
        </div>
    </section>


    <section class="how-it-works py-5 section-F9F9FF">
        <div class="container text-center">
            <h2 class="fw-bold mb-2" style="font-size: 40px;">كيف تعمل المنصة</h2>
            <p class="text-muted mb-5" style="font-size: 20px;">خطوات بسيطة للبدء في التعلم</p>
            <div class="steps-wrapper px-3 d-sm">
                <div class="step-item">
                    <div class="step-content">
                        <h5 class="fw-bold">سجّل الدخول للمنصة</h5>
                        <p class="text-muted mb-0">أنشئ حسابك أو قم بتسجيل الدخول</p>
                    </div>
                    <div class="step-number">1</div>
                </div>
                <div class="step-item">
                    <div class="step-content">
                        <h5 class="fw-bold">اختر صفك الدراسي</h5>
                        <p class="text-muted mb-0">من الصف الأول حتى الثاني عشر</p>
                    </div>
                    <div class="step-number">2</div>
                </div>
                <div class="step-item">
                    <div class="step-content">
                        <h5 class="fw-bold">اختر المادة</h5>
                        <p class="text-muted mb-0">حدد المادة التي تريد التدرب عليها</p>
                    </div>
                    <div class="step-number">3</div>
                </div>
                <div class="step-item">
                    <div class="step-content">
                        <h5 class="fw-bold">ابدأ الاختبار</h5>
                        <p class="text-muted mb-0">أجب عن الأسئلة خلال الوقت المحدد</p>
                    </div>
                    <div class="step-number">4</div>
                </div>
                <div class="step-item">
                    <div class="step-content">
                        <h5 class="fw-bold">احصل على النتيجة</h5>
                        <p class="text-muted mb-0">تقييم فوري مع تحليل أدائك</p>
                    </div>
                    <div class="step-number">5</div>
                </div>
            </div>
        </div>
    </section>


    <section class="container-fluid my-5 px-lg-5 px-3 d-sm">
        <div class="access-section">
            <div class="text-center text-white">
                <div class="access-icon mb-3"><i class="bi bi-universal-access"></i></div>
                <h1 class="fw-bold mb-3">منصة للجميع</h1>
                <p class="lead mb-4 access-text">صممنا المنصة لتكون سهلة الاستخدام للجميع، مع دعم كامل للقراءة الصوتية
                    لضمان وصول التعليم لكل طالب</p>
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <div class="access-pill"><i class="bi bi-clock"></i> متاح 24/7</div>
                    <div class="access-pill"><i class="bi bi-graph-up"></i> تتبع التقدم</div>
                    <div class="access-pill"><i class="bi bi-award"></i> شهادات إنجاز</div>
                </div>
            </div>
        </div>
    </section>


    <section class="cta-section text-center">
        <div class="container">
            <h2 class="fw-bold mb-3" style="font-size: 40px;">جاهز لتحسين مستواك الدراسي؟</h2>
            <p class="cta-text mb-4" style="font-size: 20px;">انضم لآلاف الطلاب الذين يستخدمون منصتنا يوميًا لتحقيق
                التميز الأكاديمي</p>
            <a href="{{ route('register') }}" class="btn cta-btn">ابدأ مجانًا الآن</a>
        </div>
    </section>

</x-app-layout>
