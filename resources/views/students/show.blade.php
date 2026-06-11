@extends('layout')
@section('title', 'Student Details')
@section('content')


{{-- Page header --}}
<h4 class="fw-bold mb-4" style="color:#1a202c;">
    <i class="fas fa-user-graduate me-2" style="color:#2B6CB0;"></i>Student Profile
</h4>

<div class="row g-4">
    <div class="col-md-4">
        <div style="background:#fff;border-radius:12px;padding:28px;box-shadow:0 2px 8px rgba(0,0,0,.08);text-align:center;">
            <img src="/image/{{ $student->image }}" onerror="this.src='/img/student.jpg'"
                 width="100" height="100" style="border-radius:50%;object-fit:cover;border:4px solid #2B6CB0;margin-bottom:16px;">
            <h5 class="fw-bold mb-1">{{ $student->name }}</h5>
            <span class="badge" style="background:#EBF8FF;color:#2B6CB0;font-size:12px;padding:6px 14px;border-radius:20px;">{{ $student->section }}</span>
            <hr>
            <div class="text-start" style="font-size:13px;">
                <div class="d-flex align-items-center gap-2 mb-2 p-2" style="background:#f8fafc;border-radius:8px;">
                    <i class="fas fa-envelope" style="color:#2B6CB0;width:16px;"></i>
                    <span>{{ $student->email }}</span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2 p-2" style="background:#f8fafc;border-radius:8px;">
                    <i class="fas fa-phone" style="color:#2B6CB0;width:16px;"></i>
                    <span>{{ $student->phone }}</span>
                </div>
                <div class="d-flex align-items-center gap-2 p-2" style="background:#f8fafc;border-radius:8px;">
                    <i class="fas fa-chalkboard-teacher" style="color:#2B6CB0;width:16px;"></i>
                    <span>{{ $student->teacher ? $student->teacher->name : 'No teacher assigned' }}</span>
                </div>
            </div>
            <div class="d-flex gap-2 justify-content-center mt-3">
                <a href="{{ url('/students') }}" class="btn btn-sm btn-secondary">← Back</a>
                @if(auth()->user()->isAdmin())
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form method="POST" action="{{ route('students.destroy', $student->id) }}" class="delete-form">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,.08);overflow:hidden;">
            <div style="background:linear-gradient(135deg,#2B6CB0,#1e4d7b);padding:16px 22px;color:#fff;">
                <h5 class="mb-0 fw-bold">
                    <i class="fas fa-book-open me-2"></i>Enrolled Courses & Grades
                    <span class="badge bg-white text-primary ms-2" style="font-size:12px;">{{ $student->courses->count() }}</span>
                </h5>
            </div>
            @if($student->courses->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr><th>Course</th><th>Schedule</th><th>Room</th><th>Grade</th><th>Letter</th></tr>
                    </thead>
                    <tbody>
                        @foreach($student->courses as $course)
                        @php
                            $enrollment = \App\Models\Enrollment::where('course_id', $course->id)->where('student_id', $student->id)->first();
                            $grade  = $enrollment?->grade;
                            $letter = $enrollment?->grade_letter;
                            $gradeColor = match($letter) {
                                'A+','A' => '#38a169', 'B' => '#2B6CB0', 'C' => '#d69e2e', 'D' => '#e07b39', 'F' => '#e53e3e', default => '#a0aec0',
                            };
                        @endphp
                        <tr>
                            <td class="fw-bold">{{ $course->name }}</td>
                            <td class="text-muted" style="font-size:12px;">{{ $course->schedule }}</td>
                            <td class="text-muted" style="font-size:12px;">{{ $course->room }}</td>
                            <td>
                                @if($grade !== null)
                                    <strong style="color:{{ $gradeColor }};font-size:16px;">{{ $grade }}/20</strong>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @if($letter)
                                <span class="badge fw-bold" style="background:{{ $gradeColor }};color:#fff;font-size:13px;padding:5px 10px;border-radius:6px;">{{ $letter }}</span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-4 text-center text-muted">
                <i class="fas fa-book-open fa-2x mb-2 d-block" style="opacity:.2;"></i>
                Not enrolled in any course yet.
            </div>
            @endif
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', e => { if (!confirm('Delete this student?')) e.preventDefault(); });
});
</script>
@endsection
