@extends('layout')
@section('title', 'Course Details')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0" style="color:#1a202c;">
        <i class="fas fa-book-open me-2" style="color:#2B6CB0;"></i>Course Details
    </h4>
</div>

@if(session('success'))
    <div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger"><i class="fas fa-times-circle me-2"></i>{{ session('error') }}</div>
@endif

{{-- Course Info Card --}}
<div class="row g-3 mb-4">
    <div class="col-md-8">
        <div style="background:#fff;border-radius:12px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,.08);border-left:4px solid #2B6CB0;">
            <h4 class="fw-bold mb-3" style="color:#1a202c;">
                <i class="fas fa-book-open me-2" style="color:#2B6CB0;"></i>{{ $course->name }}
            </h4>
            <div class="row g-2">
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fas fa-clock" style="color:#2B6CB0;width:16px;"></i>
                        <span class="text-muted" style="font-size:12px;text-transform:uppercase;letter-spacing:.5px;">Schedule</span>
                    </div>
                    <strong>{{ $course->schedule }}</strong>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fas fa-door-open" style="color:#2B6CB0;width:16px;"></i>
                        <span class="text-muted" style="font-size:12px;text-transform:uppercase;letter-spacing:.5px;">Room</span>
                    </div>
                    <strong>{{ $course->room }}</strong>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fas fa-chalkboard-teacher" style="color:#2B6CB0;width:16px;"></i>
                        <span class="text-muted" style="font-size:12px;text-transform:uppercase;letter-spacing:.5px;">Teacher</span>
                    </div>
                    <strong>{{ $course->teacher ? $course->teacher->name : 'Not assigned' }}</strong>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fas fa-info-circle" style="color:#2B6CB0;width:16px;"></i>
                        <span class="text-muted" style="font-size:12px;text-transform:uppercase;letter-spacing:.5px;">Description</span>
                    </div>
                    <strong>{{ $course->description ?? '—' }}</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div style="background:linear-gradient(135deg,#2B6CB0,#1e4d7b);border-radius:12px;padding:24px;color:#fff;text-align:center;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;">
            <div style="font-size:52px;font-weight:900;line-height:1;">{{ $course->students->count() }}</div>
            <div style="font-size:13px;opacity:.8;margin-top:6px;text-transform:uppercase;letter-spacing:1px;">Students Enrolled</div>
        </div>
    </div>
</div>

{{-- Enroll Student (Admin only) --}}
@if(auth()->user()->isAdmin())
<div style="background:#f8fafc;border-radius:12px;padding:20px;margin-bottom:24px;border:2px dashed #e8ecf1;">
    <h6 class="fw-bold mb-3" style="color:#2B6CB0;text-transform:uppercase;letter-spacing:1px;font-size:11px;">
        <i class="fas fa-user-plus me-2"></i>Enroll a Student
    </h6>
    <form method="POST" action="{{ route('courses.enroll', $course->id) }}" class="d-flex gap-2 flex-wrap">
        @csrf
        <select name="student_id" class="form-control" style="max-width:320px;" required>
            <option value="">— Select Student —</option>
            @foreach($allStudents as $student)
                @if(!$course->students->contains($student->id))
                    <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->section }})</option>
                @endif
            @endforeach
        </select>
        <button type="submit" class="btn btn-success"><i class="fas fa-plus me-1"></i> Enroll</button>
    </form>
</div>
@endif

{{-- Enrolled Students Table --}}
<h5 class="fw-bold mb-3" style="color:#1a202c;">
    <i class="fas fa-users me-2" style="color:#2B6CB0;"></i>Enrolled Students
</h5>

@if($course->students->count() > 0)
<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>#</th><th>Name</th><th>Section</th><th>Email</th>
                <th>Grade /20</th><th>Letter</th><th>Remarks</th>
                @if(auth()->user()->isAdmin())<th>Actions</th>@endif
            </tr>
        </thead>
        <tbody>
            @foreach($course->students as $student)
            @php
                $enrollment = \App\Models\Enrollment::where('course_id', $course->id)->where('student_id', $student->id)->first();
                $grade  = $enrollment?->grade;
                $letter = $enrollment?->grade_letter;
                $gradeColor = match($letter) {
                    'A+','A' => '#38a169', 'B' => '#2B6CB0', 'C' => '#d69e2e', 'D' => '#e07b39', 'F' => '#e53e3e', default => '#a0aec0',
                };
            @endphp
            <tr>
                <td class="text-muted">{{ $student->id }}</td>
                <td class="fw-bold">{{ $student->name }}</td>
                <td><span class="badge" style="background:#EBF8FF;color:#2B6CB0;border-radius:20px;padding:4px 10px;">{{ $student->section }}</span></td>
                <td class="text-muted">{{ $student->email }}</td>
                <td>
                    @if(auth()->user()->isAdmin())
                    <form method="POST" action="{{ route('courses.grade', [$course->id, $student->id]) }}" class="d-flex gap-1 align-items-center">
                        @csrf
                        <input type="number" name="grade" class="form-control form-control-sm" style="width:70px;" min="0" max="20" step="0.5" value="{{ $grade }}" placeholder="—">
                        <input type="text" name="remarks" class="form-control form-control-sm" style="width:100px;" value="{{ $enrollment?->remarks }}" placeholder="Note">
                        <button type="submit" class="btn btn-sm btn-success" title="Save grade"><i class="fas fa-save"></i></button>
                    </form>
                    @else
                        <strong style="color:{{ $gradeColor }};">{{ $grade ?? '—' }}</strong>
                    @endif
                </td>
                <td>
                    @if($letter)
                    <span class="badge fw-bold" style="background:{{ $gradeColor }};color:#fff;font-size:13px;padding:5px 10px;border-radius:6px;">{{ $letter }}</span>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td class="text-muted" style="font-size:12px;">{{ $enrollment?->remarks ?? '—' }}</td>
                @if(auth()->user()->isAdmin())
                <td>
                    <form method="POST" action="{{ route('courses.unenroll', [$course->id, $student->id]) }}" class="delete-form">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Remove from course"><i class="fas fa-user-minus"></i></button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div style="background:#fffbeb;border-radius:12px;padding:32px;text-align:center;border-left:4px solid #d69e2e;">
    <i class="fas fa-users fa-3x mb-3" style="color:#d69e2e;opacity:.5;"></i>
    <p class="text-muted mb-0">No students enrolled in this course yet.</p>
</div>
@endif

<div class="mt-4 d-flex gap-2">
    <a href="{{ url('/courses') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Back</a>
    @if(auth()->user()->isAdmin())
    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary"><i class="fas fa-edit me-1"></i> Edit</a>
    <form method="POST" action="{{ route('courses.destroy', $course->id) }}" class="delete-form">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger"><i class="fas fa-trash me-1"></i> Delete</button>
    </form>
    @endif
</div>

<style>
@keyframes slideUp{from{transform:translateY(30px);opacity:0}to{transform:translateY(0);opacity:1}}
</style>
<script>
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    });
});
</script>
@endsection
