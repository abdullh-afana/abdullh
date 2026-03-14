@extends('layouts.student')

@section('title', 'الاختبار')

@section('body-class', 'page-quiz')

@section('content')
  <nav class="navbar student-header px-4 py-3">
    <div class="header-simple">
      <a class="brand-wrap text-decoration-none text-dark d-flex align-items-center gap-2" href="{{ url('/') }}">
        <img src="{{ asset('img/logo.jpg') }}" class="img-fluid" height="44" width="44" alt="الشعار">
        <strong class="text-primary brand-title">منصة بنوك الأسئلة</strong>
      </a>
      <a href="{{ route('student.units') }}" class="back-link-inline text-decoration-none text-dark d-flex align-items-center gap-2">
        <span>خروج</span><i class="bi bi-box-arrow-left"></i>
      </a>
      <div class="header-spacer" aria-hidden="true"></div>
    </div>
  </nav>

  <div class="container my-5">
      <div class="quiz-container reveal">
        <div class="quiz-timer-bar mb-4">
          <div class="container d-flex align-items-center justify-content-between">
            <span class="timer-label fw-bold">الوقت المتبقي</span>
            <div class="timer-chip bg-danger text-white px-3 py-1 rounded-pill">
              <span class="timer-dot"></span>
              <span id="timer-display">30:00</span>
            </div>
          </div>
        </div>

      <main class="quiz-wrapper">
        <div class="container">
          
          @if($questions->count() > 0)
            @foreach($questions as $index => $question)
              <div class="question-step" id="q-{{ $index }}" style="{{ $index == 0 ? '' : 'display:none' }}">
                <div class="quiz-head">
                  <div class="progress-label">{{ round((($index + 1) / $questions->count()) * 100) }}% مكتمل</div>
                  <div class="progress mb-2">
                    <div class="progress-bar" style="width: {{ (($index + 1) / $questions->count()) * 100 }}%"></div>
                  </div>
                  <div class="question-count">السؤال {{ $index + 1 }} من {{ $questions->count() }}</div>
                </div>

                <section class="question-area text-center mb-5">
                    <h2 class="question-text fw-bold mb-5">{{ $question->question_text }}</h2>

                    <div class="answers d-flex flex-column gap-3">
                      @foreach($question->options as $option)
                        <label class="answer-option p-3 border rounded shadow-sm">
                          <input type="radio" name="answer_for_q{{ $question->id }}" value="{{ $option->id }}">
                          <span class="option-text ms-2">{{ $option->option_text }}</span>
                        </label>
                      @endforeach
                    </div>
                </section>
              </div>
            @endforeach

            <div class="quiz-actions d-flex justify-content-between">
                <button class="btn btn-light px-4 border" onclick="prevQuestion()"><i class="bi bi-arrow-right"></i> السابق</button>
                
                {{-- إذا كان السؤال الأخير يظهر زر إنهاء، وإلا يظهر زر التالي --}}
                <button id="next-btn" class="btn btn-primary px-4" onclick="nextQuestion()">التالي <i class="bi bi-arrow-left"></i></button>
                <a href="{{ route('student.quiz.result') }}" id="finish-btn" class="btn btn-success px-4" style="display:none">إنهاء الاختبار</a>
            </div>
          @else
            <div class="text-center py-5">
                <h3>لا توجد أسئلة مضافة لهذه الوحدة بعد.</h3>
                <a href="{{ route('student.units') }}" class="btn btn-primary mt-3">العودة للوحدات</a>
            </div>
          @endif

          <section class="questions-strip mt-5">
              <div class="strip-title mb-2">الأسئلة</div>
              <div class="strip-items d-flex gap-2 flex-wrap">
                @foreach($questions as $index => $question)
                  <button class="btn btn-outline-primary {{ $index == 0 ? 'active' : '' }}" id="strip-{{ $index }}">{{ $index + 1 }}</button>
                @endforeach
              </div>
          </section>
        </div>
      </main>
    </div>
  </div>

  <script>
    let currentStep = 0;
    const totalQuestions = {{ $questions->count() }};

    function showStep(index) {
        document.querySelectorAll('.question-step').forEach(step => step.style.display = 'none');
        document.getElementById('q-' + index).style.display = 'block';
        
        // تحديث أزرار الأرقام
        document.querySelectorAll('.strip-items .btn').forEach(btn => btn.classList.remove('active'));
        document.getElementById('strip-' + index).classList.add('active');

        // إظهار زر الإنهاء في آخر سؤال
        if (index === totalQuestions - 1) {
            document.getElementById('next-btn').style.display = 'none';
            document.getElementById('finish-btn').style.display = 'block';
        } else {
            document.getElementById('next-btn').style.display = 'block';
            document.getElementById('finish-btn').style.display = 'none';
        }
    }

    function nextQuestion() {
        if (currentStep < totalQuestions - 1) {
            currentStep++;
            showStep(currentStep);
        }
    }

    function prevQuestion() {
        if (currentStep > 0) {
            currentStep--;
            showStep(currentStep);
        }
    }

    // كود المؤقت الزمني
    document.addEventListener('DOMContentLoaded', function() {
        let timeInMinutes = 30; 
        let timeInSeconds = timeInMinutes * 60;
        const timerElement = document.getElementById('timer-display');
        const countdown = setInterval(() => {
            let minutes = Math.floor(timeInSeconds / 60);
            let seconds = timeInSeconds % 60;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            if (timerElement) timerElement.textContent = `${minutes}:${seconds}`;
            if (timeInSeconds <= 0) {
                clearInterval(countdown);
                alert("انتهى وقت الاختبار!");
            } else {
                timeInSeconds--;
            }
        }, 1000);
    });
  </script>
@endsection