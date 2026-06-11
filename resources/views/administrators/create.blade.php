@extends('layout')
@section('title', 'Add New Administrator')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ url('/administrators') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
        <h4 class="fw-bold mb-0"><i class="fas fa-user-shield me-2" style="color:#2B6CB0;"></i>Add New Administrator</h4>
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
            <form method="POST" action="{{ route('administrators.store') }}" enctype="multipart/form-data">
                @csrf
                <h6 class="fw-bold mb-3" style="color:#2B6CB0;text-transform:uppercase;letter-spacing:1px;font-size:11px;">
                    <i class="fas fa-user me-2"></i>Personal Information
                </h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="John Doe" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email <small class="text-muted">(login)</small></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="admin@school.com" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="0612345678" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="Admin" readonly style="background:#f8fafc;color:#718096;cursor:not-allowed;" />
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
                    <a href="{{ url('/administrators') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success px-5"><i class="fas fa-plus me-2"></i>Add Administrator</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div style="background:#FFF5F5;border-radius:12px;padding:20px;border-left:4px solid #e53e3e;">
            <h6 class="fw-bold mb-2" style="color:#9B2C2C;"><i class="fas fa-shield-alt me-2"></i>Admin Access</h6>
            <p style="font-size:13px;color:#744210;margin:0;">
                Administrators have full access to the system including creating, editing and deleting all records. Create admin accounts carefully.
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
