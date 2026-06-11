@extends('layout')
@section('title', 'Administrator Details')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0" style="color:#1a202c;">
        <i class="fas fa-user-shield me-2" style="color:#2B6CB0;"></i>Administrator Profile
    </h4>
</div>

<div class="row g-4 justify-content-center">
    <div class="col-md-6">
        <div style="background:#fff;border-radius:12px;padding:32px;box-shadow:0 2px 8px rgba(0,0,0,.08);text-align:center;">
            <img src="/image/{{ $administrator->image }}" onerror="this.src='/img/administrator.png'"
                 width="100" height="100" style="border-radius:50%;object-fit:cover;border:4px solid #2B6CB0;margin-bottom:16px;">
            <h5 class="fw-bold mb-1">{{ $administrator->name }}</h5>
            <span class="badge" style="background:#FFF5F5;color:#9B2C2C;font-size:12px;padding:6px 14px;border-radius:20px;">
                <i class="fas fa-shield-alt me-1"></i>Administrator
            </span>
            <hr class="my-3">
            <div class="text-start" style="font-size:13px;">
                <div class="d-flex align-items-center gap-2 mb-2 p-2" style="background:#f8fafc;border-radius:8px;">
                    <i class="fas fa-envelope" style="color:#2B6CB0;width:16px;"></i>
                    <span>{{ $administrator->email }}</span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2 p-2" style="background:#f8fafc;border-radius:8px;">
                    <i class="fas fa-phone" style="color:#2B6CB0;width:16px;"></i>
                    <span>{{ $administrator->phone }}</span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2 p-2" style="background:#f8fafc;border-radius:8px;">
                    <i class="fas fa-user-circle" style="color:#2B6CB0;width:16px;"></i>
                    <span>Login Account:
                        @if($administrator->user)
                            <span class="badge bg-success ms-1">Active</span>
                        @else
                            <span class="badge bg-warning text-dark ms-1">Not linked</span>
                        @endif
                    </span>
                </div>
            </div>
            <div class="d-flex gap-2 justify-content-center mt-3">
                <a href="{{ url('/administrators') }}" class="btn btn-secondary btn-sm">← Back</a>
                @if(auth()->user()->isAdmin())
                <a href="{{ route('administrators.edit', $administrator->id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit me-1"></i>Edit
                </a>
                <form method="POST" action="{{ route('administrators.destroy', $administrator->id) }}" class="delete-form">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash me-1"></i>Delete</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
@keyframes slideUp{from{transform:translateY(30px);opacity:0}to{transform:translateY(0);opacity:1}}
</style>
<script>
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', e => { if (!confirm('Delete this administrator and their login account?')) e.preventDefault(); });
});
</script>
@endsection
