@extends('layout')
@section('title', 'Add New Course')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ url('/courses') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
        <h4 class="fw-bold mb-0"><i class="fas fa-book-open me-2" style="color:#2B6CB0;"></i>Add New Course</h4>
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
            <form method="POST" action="{{ route('courses.store') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Course Name</label>
                        <select name="name" class="form-control" required>
                            @foreach(['Math','SVT','Physics','Chemistry','Biology','Informatique','French','English','Arabic','History','Philosophy'] as $sub)
                                <option value="{{ $sub }}" {{ old('name') == $sub ? 'selected' : '' }}>{{ $sub }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Teacher</label>
                        <select name="teacher_id" class="form-control">
                            <option value="">— No Teacher Assigned —</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                    {{ $teacher->name }} ({{ $teacher->subject }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Schedule</label>
                        <input type="text" class="form-control" name="schedule" value="{{ old('schedule') }}" placeholder="Monday 08h-10h" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Room</label>
                        <input type="text" class="form-control" name="room" value="{{ old('room') }}" placeholder="Salle 01" required />
                    </div>
                    <div class="col-12">
                        <label class="form-label">Description <small class="text-muted">(optional)</small></label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Brief description of the course content...">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url('/courses') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success px-5"><i class="fas fa-plus me-2"></i>Add Course</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div style="background:#FFFFF0;border-radius:12px;padding:20px;border-left:4px solid #d69e2e;">
            <h6 class="fw-bold mb-2" style="color:#744210;"><i class="fas fa-lightbulb me-2"></i>Tips</h6>
            <p style="font-size:13px;color:#744210;margin:0;">
                Schedule format: <strong>Monday 08h-10h</strong><br>
                Room format: <strong>Salle 01</strong><br><br>
                Assign a teacher to link the course to their schedule. Students can be enrolled after the course is created.
            </p>
        </div>
    </div>
</div>

<style>
@keyframes slideUp{from{transform:translateY(30px);opacity:0}to{transform:translateY(0);opacity:1}}
</style>
<script>
</script>
@endsection
