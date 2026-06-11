@extends('layout')
@section('title', 'Teacher Details')
@section('content')


<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0" style="color:#1a202c;">
    <i class="fas fa-chalkboard-teacher me-2" style="color:#2B6CB0;"></i>Teacher Profile
</h4>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div style="background:#fff;border-radius:12px;padding:28px;box-shadow:0 2px 8px rgba(0,0,0,.08);text-align:center;">
            <img src="/image/{{ $teacher->image }}" onerror="this.src='/img/teacher.png'"
                 width="100" height="100" style="border-radius:50%;object-fit:cover;border:4px solid #2B6CB0;margin-bottom:16px;">
            <h5 class="fw-bold mb-1">{{ $teacher->name }}</h5>
            <span class="badge" style="background:#F0FFF4;color:#276749;font-size:12px;padding:6px 14px;border-radius:20px;">{{ $teacher->subject }}</span>
            <hr>
            <div class="text-start" style="font-size:13px;">
                <p class="mb-2"><i class="fas fa-envelope me-2" style="color:#2B6CB0;"></i>{{ $teacher->email }}</p>
                <p class="mb-2"><i class="fas fa-phone me-2" style="color:#2B6CB0;"></i>{{ $teacher->phone }}</p>
                <p class="mb-0">
                    <i class="fas fa-user-circle me-2" style="color:#2B6CB0;"></i>Login:
                    @if($teacher->user)
                        <span class="badge bg-success">Linked</span>
                    @else
                        <span class="badge bg-warning text-dark">Not linked</span>
                    @endif
                </p>
            </div>
            <div class="mt-3 d-flex gap-2 justify-content-center">
                <a href="{{ url('/teachers') }}" class="btn btn-sm btn-secondary">← Back</a>
                @if(auth()->user()->isAdmin())
                <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form method="POST" action="{{ route('teachers.destroy', $teacher->id) }}" class="delete-form">
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
                    <i class="fas fa-users me-2"></i>Students in this class
                    <span class="badge bg-white text-primary ms-2" style="font-size:12px;">{{ $teacher->students->count() }}</span>
                </h5>
            </div>
            @if($teacher->students->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>#</th><th>Name</th><th>Section</th><th>Email</th></tr></thead>
                    <tbody>
                        @foreach($teacher->students as $student)
                        <tr>
                            <td class="text-muted">{{ $student->id }}</td>
                            <td class="fw-bold">{{ $student->name }}</td>
                            <td><span class="badge" style="background:#EBF8FF;color:#2B6CB0;border-radius:20px;padding:4px 10px;">{{ $student->section }}</span></td>
                            <td class="text-muted">{{ $student->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-4 text-center text-muted">
                <i class="fas fa-users fa-2x mb-2 d-block" style="opacity:.2;"></i>No students assigned yet.
            </div>
            @endif
        </div>

        @if($teacher->courses->count() > 0)
        <div style="background:#fff;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,.08);overflow:hidden;margin-top:16px;">
            <div style="background:linear-gradient(135deg,#38a169,#2f855a);padding:16px 22px;color:#fff;">
                <h5 class="mb-0 fw-bold"><i class="fas fa-book-open me-2"></i>Courses Teaching</h5>
            </div>
            <div class="p-3">
                @foreach($teacher->courses as $course)
                <div class="d-flex align-items-center gap-3 p-2 mb-1" style="border-radius:8px;background:#f8fafc;">
                    <i class="fas fa-clock" style="color:#2B6CB0;"></i>
                    <div>
                        <strong>{{ $course->name }}</strong>
                        <span class="text-muted ms-2" style="font-size:12px;">{{ $course->schedule }} — {{ $course->room }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<script>
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', e => { if (!confirm('Delete this teacher and their login account?')) e.preventDefault(); });
});
</script>
@endsection
