@extends('layouts.admin')

@section('title', 'تعديل الاختبار')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-primary">تعديل بيانات الاختبار: {{ $exam->title }}</h5>
        </div>
        <form action="{{ route('admin.exams.update', $exam->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">اسم الاختبار</label>
                        <input type="text" name="title" class="form-control" value="{{ $exam->title }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">المدة (بالدقائق)</label>
                        <input type="number" name="duration" class="form-control" value="{{ $exam->duration }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">المادة</label>
                        <select name="subject_id" class="form-select" required>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}" {{ $exam->subject_id == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->name }} ({{ $subject->grade->name ?? '' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light text-end">
                <a href="{{ route('admin.exams.index') }}" class="btn btn-secondary px-4 me-2">إلغاء</a>
                <button type="submit" class="btn btn-primary px-4">حفظ التغييرات</button>
            </div>
        </form>
    </div>
</div>
@endsection