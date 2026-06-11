@extends('layout')
@section('title', 'Add New Teacher')
@section('content')


<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ url('/teachers') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
        <h4 class="fw-bold mb-0"><i class="fas fa-chalkboard-teacher me-2" style="color:#2B6CB0;"></i>Add New Teacher</h4>
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
            <h6 class="fw-bold mb-3" style="color:#2B6CB0;text-transform:uppercase;letter-spacing:1px;font-size:11px;">
                <i class="fas fa-user me-2"></i>Personal Information
            </h6>
            <form method="POST" action="{{ route('teachers.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Ahmed Benali" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email <small class="text-muted">(login)</small></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="teacher@school.com" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="0612345678" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Subject</label>
                        <select name="subject" class="form-control" required>
                            @foreach(['Math','SVT','Physics','Chemistry','Biology','Informatique','French','English','Arabic','History','Philosophy'] as $sub)
                                <option value="{{ $sub }}" {{ old('subject') == $sub ? 'selected' : '' }}>{{ $sub }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Profile Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required />
                    </div>
                </div>
                <hr class="my-4">
                <h6 class="fw-bold mb-3" style="color:#2B6CB0;text-transform:uppercase;letter-spacing:1px;font-size:11px;">
                    <i class="fas fa-lock me-2"></i>Login Credentials
                </h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Min. 6 characters" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" required />
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url('/teachers') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success px-5"><i class="fas fa-plus me-2"></i>Add Teacher</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div style="background:#f0f7ff;border-radius:12px;padding:20px;border-left:4px solid #2B6CB0;">
            <h6 class="fw-bold mb-3" style="color:#2B6CB0;"><i class="fas fa-info-circle me-2"></i>Info</h6>
            <p style="font-size:13px;color:#4a5568;margin-bottom:8px;">
                Creating a teacher automatically creates a login account with the provided email and password.
            </p>
            <p style="font-size:13px;color:#4a5568;margin-bottom:0;">
                The teacher will only see students in their assigned section when they log in.
            </p>
        </div>
    </div>
</div>

@endsection
