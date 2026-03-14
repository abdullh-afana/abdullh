@extends('layouts.student')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">سجل نتائج الاختبارات</h2>
            <p class="text-muted">هنا يمكنك مراجعة كافة الاختبارات التي أتممتها</p>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center">المادة والوحدة</th>
                        <th class="text-center">عدد الأسئلة</th>
                        <th class="text-center">الدرجة</th>
                        <th class="text-center">التاريخ</th>
                        <th class="text-center">الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- ملاحظة: تأكد من تمرير متغير $results من الـ Controller --}}
                    @forelse($results as $result)
                        <tr>
                            <td class="text-center">
                                <span class="fw-bold d-block">{{ $result->unit->subject->name ?? 'اللغة العربية' }}</span>
                                <small class="text-muted">{{ $result->unit->name ?? 'وحدة غير محددة' }}</small>
                            </td>
                            <td class="text-center">{{ $result->total_question }}</td>
                            <td class="text-center">
                                <span class="badge {{ $result->score >= 50 ? 'bg-success' : 'bg-danger' }} fs-6">
                                    %{{ number_format($result->score, 0) }}
                                </span>
                            </td>
                            <td class="text-center text-muted small">
                                {{ $result->created_at->format('Y-m-d H:i') }}
                            </td>
                            <td class="text-center">
                                @if($result->score >= 50)
                                    <i class="bi bi-check-circle-fill text-success"></i> ناجح
                                @else
                                    <i class="bi bi-exclamation-triangle-fill text-warning"></i> ضعيف
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                لا يوجد نتائج مسجلة حتى الآن.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('student.dashboard') }}" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-house-door me-1"></i> العودة للرئيسية
            </a>
        </div>
    </div>
</div>
@endsection