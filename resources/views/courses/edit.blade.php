@extends('layout')
@section('title', 'Edit Course')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ url('/courses') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
        <h4 class="fw-bold mb-0"><i class="fas fa-edit me-2" style="color:#2B6CB0;"></i>Edit Course</h4>
    </div>
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
            <form method="POST" action="{{ route('courses.update', $course->id) }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Course Name</label>
                        <select name="name" class="form-control" required>
                            @foreach(['Math','SVT','Physics','Chemistry','Biology','Informatique','French','English','Arabic','History','Philosophy'] as $sub)
                                <option value="{{ $sub }}" {{ $course->name == $sub ? 'selected' : '' }}>{{ $sub }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Teacher</label>
                        <select name="teacher_id" class="form-control">
                            <option value="">— No Teacher —</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ $course->teacher_id == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }} ({{ $teacher->subject }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Schedule</label>
                        <input type="text" class="form-control" name="schedule" value="{{ $course->schedule }}" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Room</label>
                        <input type="text" class="form-control" name="room" value="{{ $course->room }}" required />
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description <small class="text-muted">(optional)</small></label>
                        <textarea name="description" class="form-control" rows="3">{{ $course->description }}</textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url('/courses') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary px-5"><i class="fas fa-save me-2"></i>Update Course</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,.08);">
            <h6 class="fw-bold mb-3" style="color:#2B6CB0;font-size:11px;text-transform:uppercase;letter-spacing:1px;">
                <i class="fas fa-info-circle me-2"></i>Current Info
            </h6>
            <div style="font-size:13px;color:#4a5568;">
                <p class="mb-2"><i class="fas fa-clock me-2" style="color:#2B6CB0;"></i>{{ $course->schedule }}</p>
                <p class="mb-2"><i class="fas fa-door-open me-2" style="color:#2B6CB0;"></i>{{ $course->room }}</p>
                <p class="mb-2"><i class="fas fa-users me-2" style="color:#2B6CB0;"></i>{{ $course->students->count() }} students enrolled</p>
            </div>
            <a href="{{ route('courses.show', $course->id) }}" class="btn btn-sm btn-outline-primary w-100 mt-2">
                <i class="fas fa-eye me-1"></i>View Course Details
            </a>
        </div>
    </div>
</div>

<style>
@keyframes slideUp{from{transform:translateY(30px);opacity:0}to{transform:translateY(0);opacity:1}}
</style>
<script>
</script>
@endsection
