@extends('layout')
@section('title', 'Edit Student')
@section('content')


<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ url('/students') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
    <h4 class="fw-bold mb-0"><i class="fas fa-edit me-2" style="color:#2B6CB0;"></i>Edit Student</h4>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle me-2"></i><strong>Please fix the following errors:</strong>
        <ul class="mb-0 mt-2">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<div class="row g-4">
    <div class="col-md-8">
        <div style="background:#fff;border-radius:12px;padding:28px;box-shadow:0 2px 8px rgba(0,0,0,.08);">
            <form method="POST" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $student->name }}" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $student->email }}" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ $student->phone }}" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Section</label>
                        <select name="section" class="form-control" required>
                            @foreach(['Math','SVT','Physics','Chemistry','Biology','Informatique','French','English','Arabic','History','Philosophy'] as $sec)
                                <option value="{{ $sec }}" {{ $student->section == $sec ? 'selected' : '' }}>{{ $sec }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Assigned Teacher <small class="text-muted">(optional)</small></label>
                        <select name="teacher_id" class="form-control">
                            <option value="">— No Teacher —</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ $student->teacher_id == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }} ({{ $teacher->subject }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Change Photo <small class="text-muted">(optional)</small></label>
                        <input type="file" name="image" class="form-control" accept="image/*" />
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url('/students') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary px-5"><i class="fas fa-save me-2"></i>Update Student</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,.08);text-align:center;">
            <img src="/image/{{ $student->image }}" onerror="this.src='/img/student.jpg'"
                 width="80" height="80" style="border-radius:50%;object-fit:cover;border:4px solid #2B6CB0;margin-bottom:10px;">
            <h6 class="fw-bold">{{ $student->name }}</h6>
            <span class="badge" style="background:#EBF8FF;color:#2B6CB0;border-radius:20px;padding:5px 12px;">{{ $student->section }}</span>
            <hr>
            <div style="font-size:12px;color:#718096;">
                <p class="mb-1"><i class="fas fa-book-open me-1"></i> {{ $student->courses->count() }} courses enrolled</p>
            </div>
        </div>
    </div>
</div>

@endsection
