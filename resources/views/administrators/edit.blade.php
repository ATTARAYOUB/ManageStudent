@extends('layout')
@section('title', 'Edit Administrator')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ url('/administrators') }}" class="btn btn-sm btn-outline-secondary">← Back</a>
        <h4 class="fw-bold mb-0"><i class="fas fa-edit me-2" style="color:#2B6CB0;"></i>Edit Administrator</h4>
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
            <form method="POST" action="{{ route('administrators.update', $administrator->id) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <h6 class="fw-bold mb-3" style="color:#2B6CB0;text-transform:uppercase;letter-spacing:1px;font-size:11px;">
                    <i class="fas fa-user me-2"></i>Personal Information
                </h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $administrator->name }}" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email <small class="text-muted">(login)</small></label>
                        <input type="email" class="form-control" name="email" value="{{ $administrator->email }}" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{ $administrator->phone }}" required />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="Admin" readonly style="background:#f8fafc;color:#718096;" />
                    </div>
                    <div class="col-12">
                        <label class="form-label">Current Photo</label><br>
                        <img src="/image/{{ $administrator->image }}" onerror="this.src='/img/administrator.png'"
                             width="72" height="72" style="border-radius:50%;object-fit:cover;border:3px solid #2B6CB0;margin-bottom:8px;"><br>
                        <label class="form-label">Change Photo <small class="text-muted">(optional)</small></label>
                        <input type="file" name="image" class="form-control" accept="image/*" />
                    </div>
                </div>
                <hr class="my-4">
                <h6 class="fw-bold mb-3" style="color:#2B6CB0;text-transform:uppercase;letter-spacing:1px;font-size:11px;">
                    <i class="fas fa-lock me-2"></i>Change Password <small class="fw-normal text-muted">(blank = keep current)</small>
                </h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" name="password" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" />
                    </div>
                </div>
                @if($administrator->user)
                <div class="alert alert-info mt-3 mb-0" style="font-size:13px;">
                    <i class="fas fa-link me-2"></i>Linked account: <strong>{{ $administrator->user->email }}</strong>
                </div>
                @else
                <div class="alert alert-warning mt-3 mb-0" style="font-size:13px;">
                    <i class="fas fa-exclamation-triangle me-2"></i>No login account linked.
                </div>
                @endif
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url('/administrators') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary px-5"><i class="fas fa-save me-2"></i>Update Administrator</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div style="background:#fff;border-radius:12px;padding:20px;box-shadow:0 2px 8px rgba(0,0,0,.08);text-align:center;">
            <img src="/image/{{ $administrator->image }}" onerror="this.src='/img/administrator.png'"
                 width="80" height="80" style="border-radius:50%;object-fit:cover;border:4px solid #2B6CB0;margin-bottom:10px;">
            <h6 class="fw-bold">{{ $administrator->name }}</h6>
            <span class="badge" style="background:#FFF5F5;color:#9B2C2C;">
                <i class="fas fa-shield-alt me-1"></i>Admin
            </span>
        </div>
    </div>
</div>

<style>
@keyframes slideUp{from{transform:translateY(30px);opacity:0}to{transform:translateY(0);opacity:1}}
</style>
<script>
</script>
@endsection
