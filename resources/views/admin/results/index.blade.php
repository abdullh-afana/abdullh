@extends('layouts.admin') {{-- تأكد من اسم الليوت عندك --}}

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">إدارة نتائج الطلاب</h2>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary rounded-pill px-4 shadow-sm">
    <i class="bi bi-house-door me-1"></i> العودة للرئيسية
</a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>الطالب</th>
                            <th>المادة / الوحدة</th>
                            <th>الأسئلة الصحيحة</th>
                            <th>الدرجة</th>
                            <th>تاريخ المحاولة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($results as $res)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary-soft text-primary rounded-circle p-2 me-2">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <span class="fw-bold">{{ $res->user->name ?? 'طالب غير معروف' }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info-light text-info">{{ $res->unit->subject->name ?? 'مادة' }}</span>
                                <div class="small text-muted">{{ $res->unit->name ?? 'وحدة' }}</div>
                            </td>
                            <td>
                                <span class="text-success">{{ $res->correct_answer }}</span> / {{ $res->total_question }}
                            </td>
                            <td>
                                <div class="fw-bold {{ $res->score >= 50 ? 'text-success' : 'text-danger' }}">
                                    %{{ number_format($res->score, 1) }}
                                </div>
                            </td>
                            <td class="small text-muted">
                                {{ $res->created_at->format('Y-m-d') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $results->links() }} {{-- للتنقل بين الصفحات --}}
            </div>
        </div>
    </div>
</div>

<style>
    .bg-primary-soft { background-color: #eef2ff; }
    .bg-info-light { background-color: #e0f2fe; }
    .table thead th { font-size: 0.85rem; letter-spacing: 0.5px; }
</style>
@endsection