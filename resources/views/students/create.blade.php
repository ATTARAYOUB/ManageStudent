@extends('layout')
@section('title', 'Add New Student')
@section('content')


<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ url('/students') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
    <h4 class="fw-bold mb-0"><i class="fas fa-user-graduate me-2" style="color:#2B6CB0;"></i>Add New Student</h4>
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
            <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ali Hassan" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="student@school.com" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="0612345678" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Section</label>
                        <select name="section" class="form-control" required>
                            @foreach(['Math','SVT','Physics','Chemistry','Biology','Informatique','French','English','Arabic','History','Philosophy'] as $sec)
                                <option value="{{ $sec }}" {{ old('section') == $sec ? 'selected' : '' }}>{{ $sec }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Assigned Teacher <small class="text-muted">(optional)</small></label>
                        <select name="teacher_id" class="form-control">
                            <option value="">— No Teacher —</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }} ({{ $teacher->subject }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Profile Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required />
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url('/students') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success px-5"><i class="fas fa-plus me-2"></i>Add Student</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div style="background:#EBF8FF;border-radius:12px;padding:20px;border-left:4px solid #2B6CB0;">
            <h6 class="fw-bold mb-2" style="color:#2B6CB0;"><i class="fas fa-info-circle me-2"></i>Info</h6>
            <p style="font-size:13px;color:#2c5282;margin:0;">
                The student's section should match the teacher's subject for proper assignment.
                After creating, enroll the student in courses from the <strong>Courses</strong> page.
            </p>
        </div>
    </div>
</div>
@endsection
