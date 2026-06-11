@extends('layout')
@section('title', 'Dashboard')
@section('content')

@if(auth()->user()->isAdmin())
{{-- ═══════════════ ADMIN DASHBOARD ═══════════════ --}}

<style>
.stat-card{border:none;border-radius:12px;padding:22px 18px;display:flex;align-items:center;gap:16px;box-shadow:0 2px 8px rgba(0,0,0,.08);transition:transform .15s,box-shadow .15s;text-decoration:none;color:inherit;}
.stat-card:hover{transform:translateY(-4px);box-shadow:0 8px 20px rgba(0,0,0,.12);color:inherit;text-decoration:none;}
.stat-icon{width:52px;height:52px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0;}
.stat-number{font-size:26px;font-weight:800;line-height:1;color:#2d3748;}
.stat-label{font-size:13px;color:#718096;margin-top:3px;}
.stat-sub{font-size:11px;color:#a0aec0;margin-top:2px;}
.chart-card{background:#fff;border-radius:12px;padding:22px;box-shadow:0 2px 8px rgba(0,0,0,.08);height:100%;}
.chart-card h6{font-size:12px;font-weight:800;color:#718096;text-transform:uppercase;letter-spacing:1px;margin-bottom:16px;}
.quick-actions{background:#fff;border-radius:12px;padding:18px 22px;box-shadow:0 2px 8px rgba(0,0,0,.08);margin-top:20px;}
.action-btn{display:inline-flex;align-items:center;gap:7px;padding:8px 15px;border-radius:8px;font-size:12px;font-weight:700;text-decoration:none;margin-right:8px;margin-bottom:8px;transition:all .2s;text-transform:uppercase;letter-spacing:.4px;}
.action-btn:hover{transform:translateY(-2px);box-shadow:0 4px 12px rgba(0,0,0,.15);text-decoration:none;}
</style>

<div class="mb-4">
    <h4 class="fw-bold mb-0" style="color:#1a202c;">
        <i class="fas fa-tachometer-alt me-2" style="color:#2B6CB0;"></i>Dashboard
    </h4>
    <small class="text-muted">Welcome back, <strong>{{ auth()->user()->name }}</strong> — {{ now()->format('l, d M Y') }}</small>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <a href="{{ url('/students') }}" class="stat-card" style="background:#EBF8FF;">
            <div class="stat-icon" style="background:#BEE3F8;color:#2B6CB0;"><i class="fas fa-user-graduate"></i></div>
            <div><div class="stat-number">{{ $stats['students'] }}</div><div class="stat-label">Students</div><div class="stat-sub">Total enrolled</div></div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6">
        <a href="{{ url('/teachers') }}" class="stat-card" style="background:#F0FFF4;">
            <div class="stat-icon" style="background:#C6F6D5;color:#276749;"><i class="fas fa-chalkboard-teacher"></i></div>
            <div><div class="stat-number">{{ $stats['teachers'] }}</div><div class="stat-label">Teachers</div><div class="stat-sub">Active staff</div></div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6">
        <a href="{{ url('/courses') }}" class="stat-card" style="background:#FFFFF0;">
            <div class="stat-icon" style="background:#FEFCBF;color:#744210;"><i class="fas fa-book-open"></i></div>
            <div><div class="stat-number">{{ $stats['courses'] }}</div><div class="stat-label">Courses</div><div class="stat-sub">This term</div></div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6">
        <a href="{{ url('/courses') }}" class="stat-card" style="background:#FFF5F5;">
            <div class="stat-icon" style="background:#FED7D7;color:#9B2C2C;"><i class="fas fa-user-check"></i></div>
            <div><div class="stat-number">{{ $stats['enrollments'] }}</div><div class="stat-label">Enrollments</div><div class="stat-sub">Registrations</div></div>
        </a>
    </div>
</div>

{{-- Charts Row --}}
<div class="row g-3 mb-4">
    <div class="col-md-7">
        <div class="chart-card">
            <h6><i class="fas fa-chart-bar me-2" style="color:#2B6CB0;"></i>Students per Section</h6>
            <canvas id="sectionChart" height="90"></canvas>
        </div>
    </div>
    <div class="col-md-5">
        <div class="chart-card">
            <h6><i class="fas fa-chart-doughnut me-2" style="color:#2B6CB0;"></i>Enrollments per Course</h6>
            <canvas id="enrollChart" height="160"></canvas>
        </div>
    </div>
</div>

{{-- Quick Actions --}}
<div class="quick-actions">
    <div class="fw-bold mb-3" style="font-size:11px;color:#a0aec0;text-transform:uppercase;letter-spacing:1px;">
        <i class="fas fa-bolt me-1"></i>Quick Actions
    </div>
    <a href="{{ url('/students/create') }}" class="action-btn text-white" style="background:#3182CE;">
        <i class="fas fa-plus"></i> Add Student
    </a>
    <a href="{{ url('/teachers/create') }}" class="action-btn text-white" style="background:#38A169;">
        <i class="fas fa-plus"></i> Add Teacher
    </a>
    <a href="{{ url('/courses/create') }}" class="action-btn text-white" style="background:#D69E2E;">
        <i class="fas fa-plus"></i> Add Course
    </a>
    <a href="{{ url('/administrators/create') }}" class="action-btn text-white" style="background:#E53E3E;">
        <i class="fas fa-plus"></i> Add Admin
    </a>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const sectionLabels = @json($studentsBySection->pluck('section'));
const sectionData   = @json($studentsBySection->pluck('total'));
const colors = ['#3182CE','#38A169','#D69E2E','#E53E3E','#805AD5','#DD6B20','#319795','#E53E3E','#2C7A7B','#744210','#702459'];

new Chart(document.getElementById('sectionChart'), {
    type: 'bar',
    data: {
        labels: sectionLabels,
        datasets: [{
            label: 'Students',
            data: sectionData,
            backgroundColor: colors.slice(0, sectionLabels.length),
            borderRadius: 6,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#f0f0f0' } },
            x: { grid: { display: false } }
        }
    }
});

const courseLabels = @json($enrollmentsByCourse->pluck('name'));
const courseData   = @json($enrollmentsByCourse->pluck('students_count'));

new Chart(document.getElementById('enrollChart'), {
    type: 'doughnut',
    data: {
        labels: courseLabels,
        datasets: [{
            data: courseData,
            backgroundColor: colors,
            borderWidth: 2,
            borderColor: '#fff',
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom', labels: { font: { size: 11 }, padding: 10 } }
        },
        cutout: '60%'
    }
});
</script>


@else
{{-- ═══════════════ TEACHER DASHBOARD ═══════════════ --}}
@php
    $teacher = auth()->user()->teacher;
    $myStudentsCount = $teacher
        ? \App\Models\Student::where('section', $teacher->subject)->count()
        : 0;
    $myCourses = $teacher ? $teacher->courses()->withCount('students')->get() : collect();
@endphp

<div style="background:linear-gradient(135deg,#2B6CB0,#2C5282);border-radius:14px;padding:28px 32px;color:#fff;margin-bottom:24px;">
    <h4 class="fw-bold mb-1">Welcome, {{ auth()->user()->name }}</h4>
    <p class="mb-0" style="opacity:.8;font-size:14px;">{{ now()->format('l, d M Y') }} — Teacher Portal</p>
</div>

@if($teacher)
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div style="background:#fff;border-radius:12px;padding:28px 24px;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,.08);">
            <div style="font-size:48px;font-weight:800;color:#2B6CB0;line-height:1;">{{ $myStudentsCount }}</div>
            <div style="font-size:14px;color:#718096;margin-top:6px;">Students in your class</div>
            <a href="{{ url('/students') }}" class="btn btn-primary btn-sm mt-3">View My Students</a>
        </div>
    </div>
    <div class="col-md-4">
        <div style="background:#fff;border-radius:12px;padding:28px 24px;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,.08);">
            <div style="font-size:40px;color:#38A169;"><i class="fas fa-book-open"></i></div>
            <div style="font-size:14px;color:#718096;margin-top:10px;">Your Subject</div>
            <div style="display:inline-block;background:#EBF8FF;color:#2B6CB0;border-radius:20px;padding:6px 18px;font-size:15px;font-weight:700;margin-top:10px;">{{ $teacher->subject }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div style="background:#fff;border-radius:12px;padding:28px 24px;text-align:center;box-shadow:0 2px 8px rgba(0,0,0,.08);">
            <div style="font-size:40px;color:#718096;"><i class="fas fa-user-circle"></i></div>
            <div style="font-size:14px;color:#718096;margin-top:10px;">Your Profile</div>
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm mt-3">Edit Profile</a>
        </div>
    </div>
</div>

<h5 class="fw-bold mb-3" style="color:#1a202c;">
    <i class="fas fa-calendar-alt me-2" style="color:#2B6CB0;"></i>Your Schedule
</h5>

@if($myCourses->count() > 0)
    @foreach($myCourses as $course)
    <div style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,.08);border-left:4px solid #2B6CB0;margin-bottom:14px;transition:all .3s;">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <div style="font-size:16px;font-weight:700;color:#2d3748;margin-bottom:8px;">{{ $course->name }}</div>
                <div style="font-size:13px;color:#718096;" class="d-flex flex-wrap gap-3">
                    <span><i class="fas fa-clock me-1" style="color:#2B6CB0;"></i>{{ $course->schedule }}</span>
                    <span><i class="fas fa-door-open me-1" style="color:#718096;"></i>{{ $course->room }}</span>
                    <span><i class="fas fa-users me-1" style="color:#38A169;"></i>{{ $course->students_count }} students</span>
                </div>
                @if($course->description)
                <div style="font-size:12px;color:#a0aec0;margin-top:6px;"><i class="fas fa-info-circle me-1"></i>{{ $course->description }}</div>
                @endif
            </div>
            <a href="{{ route('courses.show', $course->id) }}" class="btn btn-sm btn-outline-primary ms-3">
                <i class="fas fa-eye"></i>
            </a>
        </div>
    </div>
    @endforeach
@else
    <div style="background:linear-gradient(135deg,#fef3c7,#fde68a);border-radius:12px;padding:32px;text-align:center;border-left:4px solid #d69e2e;">
        <i class="fas fa-calendar-times fa-3x mb-3" style="color:#d69e2e;opacity:.6;"></i>
        <h5 style="color:#92400e;font-weight:700;">No Schedule Yet</h5>
        <p style="color:#b45309;margin:0;">Contact the administrator to assign courses to you.</p>
    </div>
@endif

@else
<div class="alert alert-warning">
    <i class="fas fa-exclamation-triangle me-2"></i>
    Your account is not linked to a teacher profile yet. Contact the administrator.
</div>
@endif
@endif

@endsection
