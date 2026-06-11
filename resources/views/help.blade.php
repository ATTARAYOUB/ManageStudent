@extends('layout')
@section('title', 'User Guide')
@section('content')

<style>
.help-hero{background:linear-gradient(135deg,#2B6CB0,#1a365d);border-radius:14px;padding:36px 40px;color:#fff;margin-bottom:32px;position:relative;overflow:hidden;}
.help-hero::before{content:'';position:absolute;right:-40px;top:-40px;width:200px;height:200px;background:rgba(255,255,255,.05);border-radius:50%;}
.help-hero::after{content:'';position:absolute;right:40px;bottom:-60px;width:140px;height:140px;background:rgba(255,255,255,.04);border-radius:50%;}
.section-card{background:#fff;border-radius:14px;padding:28px 32px;box-shadow:0 2px 12px rgba(0,0,0,.07);margin-bottom:24px;border-left:5px solid #2B6CB0;}
.section-card.green{border-left-color:#38a169;}
.section-card.yellow{border-left-color:#d69e2e;}
.section-card.red{border-left-color:#e53e3e;}
.section-card.purple{border-left-color:#805ad5;}
.section-title{font-size:17px;font-weight:800;color:#1a202c;margin-bottom:18px;display:flex;align-items:center;gap:10px;}
.section-title i{width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0;}
.step{display:flex;gap:14px;align-items:flex-start;margin-bottom:14px;}
.step-num{width:28px;height:28px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:12px;flex-shrink:0;margin-top:1px;}
.step-body{font-size:13.5px;color:#4a5568;line-height:1.65;}
.step-body strong{color:#2d3748;}
.badge-action{display:inline-block;padding:2px 8px;border-radius:5px;font-size:11px;font-weight:700;margin:0 2px;vertical-align:middle;}
.tip-box{background:#EBF8FF;border-radius:10px;padding:14px 18px;border-left:4px solid #2B6CB0;margin-top:16px;font-size:13px;color:#2c5282;}
.tip-box.green{background:#F0FFF4;border-left-color:#38a169;color:#276749;}
.tip-box.yellow{background:#FFFFF0;border-left-color:#d69e2e;color:#744210;}
.tip-box.red{background:#FFF5F5;border-left-color:#e53e3e;color:#9B2C2C;}
.toc-card{background:#fff;border-radius:14px;padding:22px 26px;box-shadow:0 2px 12px rgba(0,0,0,.07);margin-bottom:24px;}
.toc-item{display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:8px;font-size:13px;font-weight:600;color:#4a5568;text-decoration:none;transition:all .2s;}
.toc-item:hover{background:#f0f7ff;color:#2B6CB0;text-decoration:none;}
.toc-item i{width:26px;text-align:center;color:#2B6CB0;}
.grade-row{display:flex;align-items:center;gap:10px;margin-bottom:8px;font-size:13px;}
.grade-badge{width:40px;height:28px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:13px;color:#fff;}
</style>

{{-- Hero --}}
<div class="help-hero">
    <div style="font-size:13px;opacity:.7;text-transform:uppercase;letter-spacing:2px;margin-bottom:8px;">
        <i class="fas fa-book-open me-2"></i>Documentation
    </div>
    <h2 class="fw-bold mb-2" style="font-size:28px;">School Management — User Guide</h2>
    <p style="opacity:.8;font-size:14px;margin:0;max-width:580px;">
        Everything you need to know about using this system: managing students, teachers, courses, grades, and administrator accounts.
    </p>
</div>

<div class="row g-4">
<div class="col-lg-3">
    {{-- Table of Contents --}}
    <div class="toc-card" style="position:sticky;top:20px;">
        <div style="font-size:10px;font-weight:900;color:#a0aec0;text-transform:uppercase;letter-spacing:2px;margin-bottom:12px;">Contents</div>
        <a class="toc-item" href="#dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a class="toc-item" href="#students"><i class="fas fa-user-graduate"></i> Students</a>
        <a class="toc-item" href="#teachers"><i class="fas fa-chalkboard-teacher"></i> Teachers</a>
        <a class="toc-item" href="#courses"><i class="fas fa-book-open"></i> Courses</a>
        <a class="toc-item" href="#grades"><i class="fas fa-star"></i> Grades</a>
        <a class="toc-item" href="#administrators"><i class="fas fa-user-shield"></i> Administrators</a>
        <a class="toc-item" href="#search"><i class="fas fa-search"></i> Live Search</a>
        <a class="toc-item" href="#roles"><i class="fas fa-lock"></i> Roles & Access</a>
    </div>
</div>

<div class="col-lg-9">

{{-- ── DASHBOARD ── --}}
<div class="section-card" id="dashboard">
    <div class="section-title">
        <i class="fas fa-tachometer-alt" style="background:#EBF8FF;color:#2B6CB0;"></i>
        Dashboard
    </div>
    <div class="step">
        <div class="step-num" style="background:#EBF8FF;color:#2B6CB0;">1</div>
        <div class="step-body"><strong>Stat Cards (top row)</strong> — Show live totals for Students, Teachers, Courses, and Enrollments. Click any card to go directly to that section's list.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#EBF8FF;color:#2B6CB0;">2</div>
        <div class="step-body"><strong>Bar Chart — Students per Section</strong> — Each bar represents a subject section (Math, SVT, Physics…). The height shows how many students are in that section. Hover over a bar to see the exact count.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#EBF8FF;color:#2B6CB0;">3</div>
        <div class="step-body"><strong>Doughnut Chart — Enrollments per Course</strong> — Each slice represents one course. Larger slices mean more students enrolled. The legend below the chart identifies each course by color.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#EBF8FF;color:#2B6CB0;">4</div>
        <div class="step-body"><strong>Quick Actions</strong> — Four shortcut buttons at the bottom: <strong>Add Student</strong>, <strong>Add Teacher</strong>, <strong>Add Course</strong>, <strong>Add Admin</strong>. Click any to jump straight to that creation form.</div>
    </div>
    <div class="tip-box"><i class="fas fa-sync me-2"></i>Charts refresh automatically every time you load the page, always reflecting live data from the database.</div>
</div>

{{-- ── STUDENTS ── --}}
<div class="section-card green" id="students">
    <div class="section-title">
        <i class="fas fa-user-graduate" style="background:#F0FFF4;color:#276749;"></i>
        Students
    </div>

    <p style="font-size:13px;color:#718096;margin-bottom:18px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">List Page</p>
    <div class="step">
        <div class="step-num" style="background:#F0FFF4;color:#276749;">1</div>
        <div class="step-body"><strong>Live Search</strong> — Type any part of a student's name or email in the search box. The table filters instantly as you type. A dropdown also shows up to 8 matching suggestions with photos — click one to jump to that student.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#F0FFF4;color:#276749;">2</div>
        <div class="step-body"><strong>Section Filter</strong> — Use the dropdown next to the search box to show only students from a specific subject section (Math, SVT, Physics, etc.). Works together with the search.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#F0FFF4;color:#276749;">3</div>
        <div class="step-body"><strong>Clear button</strong> — Resets both the search and the section filter to show all students.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#F0FFF4;color:#276749;">4</div>
        <div class="step-body">
            <strong>Action buttons</strong> per row:
            <span class="badge-action" style="background:#17a2b8;color:#fff;"><i class="fas fa-eye"></i> View</span> — Open the full student profile with grades.
            <span class="badge-action" style="background:#2B6CB0;color:#fff;"><i class="fas fa-edit"></i> Edit</span> — Update student info.
            <span class="badge-action" style="background:#e53e3e;color:#fff;"><i class="fas fa-trash"></i> Delete</span> — Permanently remove the student (confirmation required).
        </div>
    </div>

    <hr style="margin:20px 0;border-color:#e2e8f0;">
    <p style="font-size:13px;color:#718096;margin-bottom:18px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Add / Edit Form</p>
    <div class="step">
        <div class="step-num" style="background:#F0FFF4;color:#276749;">1</div>
        <div class="step-body"><strong>Name, Email, Phone</strong> — All required. Email must be unique across all students.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#F0FFF4;color:#276749;">2</div>
        <div class="step-body"><strong>Section</strong> — The student's subject group. Should match the assigned teacher's subject so they appear in the teacher's dashboard.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#F0FFF4;color:#276749;">3</div>
        <div class="step-body"><strong>Assigned Teacher</strong> — Optional. Links this student to a teacher. Leave blank if not yet decided.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#F0FFF4;color:#276749;">4</div>
        <div class="step-body"><strong>Profile Image</strong> — Required when creating. Optional when editing (leave empty to keep the current photo). JPG/PNG, max 2MB.</div>
    </div>
    <div class="tip-box green"><i class="fas fa-lightbulb me-2"></i>After creating a student, go to a <strong>Course</strong> and use the Enroll section to register them in courses.</div>
</div>

{{-- ── TEACHERS ── --}}
<div class="section-card green" id="teachers">
    <div class="section-title">
        <i class="fas fa-chalkboard-teacher" style="background:#F0FFF4;color:#276749;"></i>
        Teachers
    </div>

    <p style="font-size:13px;color:#718096;margin-bottom:18px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">List Page</p>
    <div class="step">
        <div class="step-num" style="background:#F0FFF4;color:#276749;">1</div>
        <div class="step-body"><strong>Live Search</strong> — Type a name, subject, or email. Results filter instantly; the suggestion dropdown shows matching teacher cards with photos.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#F0FFF4;color:#276749;">2</div>
        <div class="step-body"><strong>Students column</strong> — Shows how many students are currently assigned to each teacher.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#F0FFF4;color:#276749;">3</div>
        <div class="step-body">
            <strong>Action buttons:</strong>
            <span class="badge-action" style="background:#17a2b8;color:#fff;"><i class="fas fa-eye"></i> View</span> shows the teacher's profile, their student list, and courses they teach.
            <span class="badge-action" style="background:#2B6CB0;color:#fff;"><i class="fas fa-edit"></i> Edit</span> to update info.
            <span class="badge-action" style="background:#e53e3e;color:#fff;"><i class="fas fa-trash"></i> Delete</span> removes the teacher <em>and</em> their login account.
        </div>
    </div>

    <hr style="margin:20px 0;border-color:#e2e8f0;">
    <p style="font-size:13px;color:#718096;margin-bottom:18px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Add / Edit Form</p>
    <div class="step">
        <div class="step-num" style="background:#F0FFF4;color:#276749;">1</div>
        <div class="step-body"><strong>Email</strong> — Becomes the teacher's login username. Must be unique across the entire system.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#F0FFF4;color:#276749;">2</div>
        <div class="step-body"><strong>Subject</strong> — The teacher's discipline. Students assigned to this teacher should be in the matching section.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#F0FFF4;color:#276749;">3</div>
        <div class="step-body"><strong>Password</strong> — Set on creation (min. 6 characters). On the edit form, leave both password fields <em>blank</em> to keep the current password unchanged.</div>
    </div>
    <div class="tip-box green"><i class="fas fa-info-circle me-2"></i>Adding a teacher automatically creates a login account. They can log in immediately with the email and password you set. They will only see their own students and courses.</div>
</div>

{{-- ── COURSES ── --}}
<div class="section-card yellow" id="courses">
    <div class="section-title">
        <i class="fas fa-book-open" style="background:#FFFFF0;color:#744210;"></i>
        Courses
    </div>

    <p style="font-size:13px;color:#718096;margin-bottom:18px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">List Page</p>
    <div class="step">
        <div class="step-num" style="background:#FFFFF0;color:#744210;">1</div>
        <div class="step-body"><strong>Live Search</strong> — Type a course name, room number, or schedule. The suggestion dropdown shows matching courses with their schedule and room.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#FFFFF0;color:#744210;">2</div>
        <div class="step-body"><strong>Students column</strong> — Shows how many students are enrolled in each course.</div>
    </div>

    <hr style="margin:20px 0;border-color:#e2e8f0;">
    <p style="font-size:13px;color:#718096;margin-bottom:18px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Add / Edit Form</p>
    <div class="step">
        <div class="step-num" style="background:#FFFFF0;color:#744210;">1</div>
        <div class="step-body"><strong>Course Name</strong> — Select from the subject dropdown (Math, SVT, Physics, etc.).</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#FFFFF0;color:#744210;">2</div>
        <div class="step-body"><strong>Teacher</strong> — Optional. Assigning a teacher makes this course appear in their dashboard schedule.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#FFFFF0;color:#744210;">3</div>
        <div class="step-body"><strong>Schedule</strong> — Use the format: <code style="background:#f0f0f0;padding:1px 5px;border-radius:4px;">Monday 08h-10h</code></div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#FFFFF0;color:#744210;">4</div>
        <div class="step-body"><strong>Room</strong> — Use the format: <code style="background:#f0f0f0;padding:1px 5px;border-radius:4px;">Salle 01</code> or <code style="background:#f0f0f0;padding:1px 5px;border-radius:4px;">Lab B</code></div>
    </div>

    <hr style="margin:20px 0;border-color:#e2e8f0;">
    <p style="font-size:13px;color:#718096;margin-bottom:18px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Course Detail Page (View)</p>
    <div class="step">
        <div class="step-num" style="background:#FFFFF0;color:#744210;">1</div>
        <div class="step-body"><strong>Enroll a Student</strong> — Select a student from the dropdown and click <strong>Enroll</strong>. Only students not yet enrolled in this course are shown.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#FFFFF0;color:#744210;">2</div>
        <div class="step-body"><strong>Edit Grade</strong> — Type a number (0–20) in the grade input and optionally a remark, then click <i class="fas fa-save" style="color:#38a169;"></i> to save. The letter grade is calculated automatically.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#FFFFF0;color:#744210;">3</div>
        <div class="step-body"><strong>Remove Student</strong> — Click the <span class="badge-action" style="background:#e53e3e;color:#fff;"><i class="fas fa-user-minus"></i></span> red button on a student's row to unenroll them. Their grade data is also removed. Confirmation required.</div>
    </div>
    <div class="tip-box yellow"><i class="fas fa-info-circle me-2"></i>Editing a course (name, schedule, room, teacher) never affects existing enrollments or grades.</div>
</div>

{{-- ── GRADES ── --}}
<div class="section-card" id="grades" style="border-left-color:#805ad5;">
    <div class="section-title">
        <i class="fas fa-star" style="background:#faf5ff;color:#805ad5;"></i>
        Grade Scale
    </div>
    <p style="font-size:13px;color:#718096;margin-bottom:18px;">Grades are entered out of <strong>20</strong>. The system automatically calculates the letter grade:</p>
    <div>
        <div class="grade-row"><div class="grade-badge" style="background:#38a169;">A+</div><strong>18 – 20</strong><span class="text-muted ms-2">Excellent</span></div>
        <div class="grade-row"><div class="grade-badge" style="background:#38a169;">A</div><strong>16 – 17.5</strong><span class="text-muted ms-2">Very Good</span></div>
        <div class="grade-row"><div class="grade-badge" style="background:#2B6CB0;">B</div><strong>14 – 15.5</strong><span class="text-muted ms-2">Good</span></div>
        <div class="grade-row"><div class="grade-badge" style="background:#d69e2e;">C</div><strong>12 – 13.5</strong><span class="text-muted ms-2">Average</span></div>
        <div class="grade-row"><div class="grade-badge" style="background:#e07b39;">D</div><strong>10 – 11.5</strong><span class="text-muted ms-2">Below Average</span></div>
        <div class="grade-row"><div class="grade-badge" style="background:#e53e3e;">F</div><strong>0 – 9.5</strong><span class="text-muted ms-2">Fail</span></div>
    </div>
    <div class="tip-box" style="margin-top:16px;"><i class="fas fa-info-circle me-2"></i>A dash <strong>—</strong> in the grade column means no grade has been entered yet. Grades can be updated any number of times.</div>
</div>

{{-- ── ADMINISTRATORS ── --}}
<div class="section-card red" id="administrators">
    <div class="section-title">
        <i class="fas fa-user-shield" style="background:#FFF5F5;color:#9B2C2C;"></i>
        Administrators
    </div>

    <p style="font-size:13px;color:#718096;margin-bottom:18px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">List Page</p>
    <div class="step">
        <div class="step-num" style="background:#FFF5F5;color:#9B2C2C;">1</div>
        <div class="step-body"><strong>Live Search</strong> — Type a name or email. The table filters instantly; the dropdown shows matching admin profiles.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#FFF5F5;color:#9B2C2C;">2</div>
        <div class="step-body">
            <strong>Action buttons:</strong>
            <span class="badge-action" style="background:#17a2b8;color:#fff;"><i class="fas fa-eye"></i> View</span> — Full profile with login status.
            <span class="badge-action" style="background:#2B6CB0;color:#fff;"><i class="fas fa-edit"></i> Edit</span> — Update info or password.
            <span class="badge-action" style="background:#e53e3e;color:#fff;"><i class="fas fa-trash"></i> Delete</span> — Removes the admin <em>and</em> their login account (confirmation required).
        </div>
    </div>

    <hr style="margin:20px 0;border-color:#e2e8f0;">
    <p style="font-size:13px;color:#718096;margin-bottom:18px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Add / Edit Form</p>
    <div class="step">
        <div class="step-num" style="background:#FFF5F5;color:#9B2C2C;">1</div>
        <div class="step-body"><strong>Email</strong> — The admin's login username. Must be unique. Changing it on edit also updates their login account.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#FFF5F5;color:#9B2C2C;">2</div>
        <div class="step-body"><strong>Password</strong> — On the edit form, leave both password fields blank to keep the current password. Only fill in when setting a new one.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#FFF5F5;color:#9B2C2C;">3</div>
        <div class="step-body"><strong>Role</strong> — Fixed to <em>Admin</em>. Cannot be changed.</div>
    </div>
    <div class="tip-box red"><i class="fas fa-shield-alt me-2"></i>Administrators have <strong>full access</strong> to create, edit, and delete all records in the system. Create admin accounts carefully and only for trusted staff.</div>
</div>

{{-- ── LIVE SEARCH ── --}}
<div class="section-card" id="search">
    <div class="section-title">
        <i class="fas fa-search" style="background:#EBF8FF;color:#2B6CB0;"></i>
        Live Search — How It Works
    </div>
    <div class="step">
        <div class="step-num" style="background:#EBF8FF;color:#2B6CB0;">1</div>
        <div class="step-body"><strong>Instant table filter</strong> — As soon as you type, every row in the table is checked. Non-matching rows are hidden immediately — no page reload required.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#EBF8FF;color:#2B6CB0;">2</div>
        <div class="step-body"><strong>Suggestion dropdown</strong> — After typing 2 or more characters, a dropdown appears below the search box showing up to 8 real matches from the database with photos and details. Click a suggestion to fill the search and focus the table.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#EBF8FF;color:#2B6CB0;">3</div>
        <div class="step-body"><strong>Dismiss</strong> — Click anywhere outside the dropdown or press <kbd style="background:#f0f0f0;border:1px solid #ccc;border-radius:4px;padding:1px 5px;font-size:11px;">Esc</kbd> to close it.</div>
    </div>
    <div class="step">
        <div class="step-num" style="background:#EBF8FF;color:#2B6CB0;">4</div>
        <div class="step-body"><strong>Clear button</strong> — Resets search and any active filters, returning to the full list.</div>
    </div>
    <div class="tip-box"><i class="fas fa-bolt me-2"></i>The search on <strong>Students</strong> also combines with the Section dropdown filter — both work together at the same time.</div>
</div>

{{-- ── ROLES & ACCESS ── --}}
<div class="section-card" id="roles" style="border-left-color:#805ad5;">
    <div class="section-title">
        <i class="fas fa-lock" style="background:#faf5ff;color:#805ad5;"></i>
        Roles &amp; Access Control
    </div>
    <div class="row g-3">
        <div class="col-md-4">
            <div style="background:#FFF5F5;border-radius:10px;padding:18px;height:100%;">
                <div style="font-weight:800;color:#9B2C2C;margin-bottom:10px;font-size:14px;"><i class="fas fa-user-shield me-2"></i>Administrator</div>
                <ul style="font-size:13px;color:#4a5568;padding-left:18px;margin:0;">
                    <li>Full access to all sections</li>
                    <li>Create, edit, delete students</li>
                    <li>Create, edit, delete teachers</li>
                    <li>Manage courses &amp; enrollments</li>
                    <li>Assign grades</li>
                    <li>Manage other admin accounts</li>
                    <li>View all charts &amp; reports</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div style="background:#F0FFF4;border-radius:10px;padding:18px;height:100%;">
                <div style="font-weight:800;color:#276749;margin-bottom:10px;font-size:14px;"><i class="fas fa-chalkboard-teacher me-2"></i>Teacher</div>
                <ul style="font-size:13px;color:#4a5568;padding-left:18px;margin:0;">
                    <li>View own students only</li>
                    <li>View own courses &amp; schedule</li>
                    <li>Cannot create or delete records</li>
                    <li>Cannot access Teachers page</li>
                    <li>Cannot access Administrators</li>
                    <li>Can edit own profile</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div style="background:#EBF8FF;border-radius:10px;padding:18px;height:100%;">
                <div style="font-weight:800;color:#2B6CB0;margin-bottom:10px;font-size:14px;"><i class="fas fa-info-circle me-2"></i>Login Status</div>
                <ul style="font-size:13px;color:#4a5568;padding-left:18px;margin:0;">
                    <li><span class="badge bg-success">Linked</span> — Account is active</li>
                    <li><span class="badge bg-warning text-dark">Not linked</span> — No login account</li>
                    <li>Teachers &amp; Admins get login accounts automatically when created</li>
                    <li>Deleting a teacher/admin also deletes their login account</li>
                </ul>
            </div>
        </div>
    </div>
</div>

</div>{{-- end col-lg-9 --}}
</div>{{-- end row --}}

@endsection
