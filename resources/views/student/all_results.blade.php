@extends('layouts.student')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0">سجل اختباراتي</h3>
            <i class="bi bi-trophy text-warning fs-2"></i>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>التاريخ</th>
                        <th>المادة / الوحدة</th>
                        <th>الدرجة</th>
                        <th>النتيجة</th>
                        <th>الإجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $res)
                        <tr>
                            <td>{{ $res->created_at->format('Y-m-d') }}</td>
                            <td>
                                <span class="fw-bold">{{ $res->unit->subject->name ?? 'مادة' }}</span>
                                <br>
                                <small class="text-muted">{{ $res->unit->name ?? 'وحدة' }}</small>
                            </td>
                            <td>
                                <div class="progress" style="height: 10px; width: 100px; margin: auto;">
                                    <div class="progress-bar {{ $res->score >= 50 ? 'bg-success' : 'bg-danger' }}" 
                                         role="progressbar" style="width: {{ $res->score }}%"></div>
                                </div>
                                <small class="fw-bold text-dark">%{{ number_format($res->score, 0) }}</small>
                            </td>
                            <td>
                                @if($res->score >= 50)
                                    <span class="badge bg-success-soft text-success px-3">ناجح</span>
                                @else
                                    <span class="badge bg-danger-soft text-danger px-3">يحتاج تحسين</span>
                                @endif
                            </td>
                            <td>
                                {{-- هنا نربط بميزة المراجعة التي برمجناها سابقاً --}}
                                <button class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    تفاصيل <i class="bi bi-eye ms-1"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-5 text-muted">
                                <i class="bi bi-info-circle d-block fs-2 mb-2"></i>
                                لم تقم بإجراء أي اختبارات بعد.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .bg-success-soft { background-color: #e8f5e9; }
    .bg-danger-soft { background-color: #ffebee; }
    .table thead th { border: none; color: #6c757d; font-size: 0.9rem; }
</style>
@endsection