<x-guest-layout>
{{-- استدعاء ملفات الـ CSS --}}
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<body class="page-quiz">
    {{-- هيدر صديقك --}}
    <nav class="navbar student-header px-4 py-3 bg-white shadow-sm">
        <div class="header-simple d-flex justify-content-between w-100 align-items-center">
            <a class="brand-wrap text-decoration-none text-dark d-flex align-items-center gap-2" href="{{ route('student.dashboard') }}">
                <img src="{{ asset('img/logo.jpg') }}" class="img-fluid" height="44" width="44" alt="الشعار">
                <strong class="text-primary brand-title">منصة بنوك الأسئلة</strong>
            </a>
            <div class="timer-chip d-flex align-items-center gap-2 bg-light px-3 py-1 rounded-pill">
                <span class="timer-dot"></span>
                <span class="fw-bold text-primary" id="quizTimer">15:00</span>
            </div>
        </div>
    </nav>

    <main class="quiz-wrapper py-5">
        <div class="container">
            {{-- رأس الاختبار --}}
            <div class="quiz-head mb-4 text-center">
                <h3 class="fw-bold mb-3">اختبار: {{ $unit->name }}</h3>
                <div class="question-count text-muted small">إجمالي الأسئلة: {{ count($questions) }}</div>
            </div>

            <form action="{{ route('student.quiz.submit') }}" method="POST" id="quizForm">
                @csrf
                <input type="hidden" name="unit_id" value="{{ $unit->id }}">

                @foreach($questions as $index => $question)
                    <section class="question-card shadow-sm border-0 rounded-4 p-4 mb-4 bg-white position-relative">
                        <div class="question-badge position-absolute top-0 start-0 translate-middle bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 40px; height: 40px; font-weight: bold; margin-left: 20px; margin-top: 20px;">
                            {{ $index + 1 }}
                        </div>
                        
                        <h4 class="question-title fw-bold mb-4 mt-2" style="padding-right: 40px;">
                            {{ $question->question_text }}
                        </h4>

                        <div class="answers d-grid gap-3">
                            {{-- إذا كان السؤال صح وخطأ --}}
                            @if($question->type == 'true_false')
                                <label class="answer-option border rounded-3 p-3 d-flex align-items-center gap-3">
                                    <input type="radio" name="ans[{{ $question->id }}]" value="صح" required>
                                    <span class="option-text fw-bold text-success">صح</span>
                                </label>
                                <label class="answer-option border rounded-3 p-3 d-flex align-items-center gap-3">
                                    <input type="radio" name="ans[{{ $question->id }}]" value="خطأ" required>
                                    <span class="option-text fw-bold text-danger">خطأ</span>
                                </label>
                            @endif

                            {{-- إذا كان السؤال اختيار من متعدد --}}
                            @if($question->type == 'mcq')
                                @foreach($question->options as $option)
                                    <label class="answer-option border rounded-3 p-3 d-flex align-items-center gap-3">
                                        <input type="radio" name="ans[{{ $question->id }}]" value="{{ trim($option->option_text) }}" required>
                                        <span class="option-text">{{ $option->option_text }}</span>
                                    </label>
                                @endforeach
                            @endif
                        </div>
                    </section>
                @endforeach

                {{-- زر الإرسال النهائي --}}
                <div class="quiz-actions mt-5 text-center">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow" 
                            style="background: linear-gradient(135deg, #28a745, #1e7e34); border: none;">
                        إنهاء الاختبار وتسليم الإجابات <i class="bi bi-send-check ms-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

<script>
    // عداد التايمر بالجافا 
    let durationInMinutes = 15;
    let timeInSeconds = durationInMinutes * 60;

    const timerDisplay = document.getElementById('quizTimer');
    const quizForm = document.getElementById('quizForm');

    const countdown = setInterval(function() {
        let minutes = Math.floor(timeInSeconds / 60);
        let seconds = timeInSeconds % 60;

     
        seconds = seconds < 10 ? '0' + seconds : seconds;
        minutes = minutes < 10 ? '0' + minutes : minutes;

        timerDisplay.innerHTML = `${minutes}:${seconds}`;

        

        timeInSeconds--;
    }, 1000);
</script>


</x-guest-layout>