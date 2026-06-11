@extends('layout')
@section('title', 'Administrators List')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-0" style="color:#1a202c;">
            <i class="fas fa-user-shield me-2" style="color:#2B6CB0;"></i>Administrators
        </h4>
        <small class="text-muted" id="resultCount">{{ $administrators->total() }} administrator(s) found</small>
    </div>
    <div class="d-flex gap-2">
        @if(auth()->user()->isAdmin())
        <a href="{{ url('/administrators/create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-plus me-1"></i> Add Administrator
        </a>
        @endif
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
@endif

{{-- Search --}}
<div class="mb-4">
    <div class="row g-2">
        <div class="col-md-5 position-relative">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" id="liveSearch" class="form-control border-start-0"
                       placeholder="Type name or email..."
                       value="{{ request('search') }}"
                       autocomplete="off">
            </div>
            <div id="liveSuggestions" style="position:absolute;z-index:1000;background:#fff;border:2px solid #e2e8f0;border-radius:10px;box-shadow:0 8px 24px rgba(0,0,0,.1);left:0;right:0;top:100%;margin-top:4px;display:none;max-height:280px;overflow-y:auto;"></div>
        </div>
        <div class="col-md-2">
            <a href="{{ url('/administrators') }}" class="btn btn-outline-secondary w-100">
                <i class="fas fa-times me-1"></i> Clear
            </a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>#</th><th>Photo</th><th>Name</th><th>Email</th><th>Phone</th><th>Role</th><th>Actions</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @forelse($administrators as $admin)
            <tr data-name="{{ strtolower($admin->name) }}" data-email="{{ strtolower($admin->email) }}">
                <td class="text-muted fw-bold">{{ $admin->id }}</td>
                <td>
                    <img src="/image/{{ $admin->image }}" onerror="this.src='/img/administrator.png'"
                         width="44" height="44" style="border-radius:50%;object-fit:cover;border:2px solid #e8ecf1;">
                </td>
                <td class="fw-bold">{{ $admin->name }}</td>
                <td class="text-muted">{{ $admin->email }}</td>
                <td>{{ $admin->phone }}</td>
                <td>
                    <span class="badge" style="background:#FFF5F5;color:#9B2C2C;font-size:11px;padding:5px 10px;border-radius:20px;">
                        <i class="fas fa-shield-alt me-1"></i>{{ ucfirst($admin->role) }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a class="btn btn-sm btn-info" href="{{ route('administrators.show', $admin->id) }}" title="View"><i class="fas fa-eye"></i></a>
                        @if(auth()->user()->isAdmin())
                        <a class="btn btn-sm btn-primary" href="{{ route('administrators.edit', $admin->id) }}" title="Edit"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('administrators.destroy', $admin->id) }}" class="delete-form">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-5 text-muted">
                    <i class="fas fa-user-shield fa-3x mb-3 d-block" style="opacity:.2;"></i>No administrators found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="noResults" class="text-center py-5 text-muted" style="display:none;">
    <i class="fas fa-search fa-3x mb-3 d-block" style="opacity:.2;"></i>
    No administrators match your search.
</div>

<div class="d-flex justify-content-between align-items-center mt-4 px-1">
    <div style="font-size:13px;color:#718096;font-weight:600;">
        <i class="fas fa-list me-1" style="color:#2B6CB0;"></i>
        Showing <strong>{{ $administrators->firstItem() }}</strong>–<strong>{{ $administrators->lastItem() }}</strong> of <strong>{{ $administrators->total() }}</strong> administrators
    </div>
    {{ $administrators->links() }}
</div>

<style>
@keyframes slideUp{from{transform:translateY(30px);opacity:0}to{transform:translateY(0);opacity:1}}
.suggestion-item{padding:10px 14px;cursor:pointer;display:flex;align-items:center;gap:10px;border-bottom:1px solid #f0f0f0;font-size:13px;}
.suggestion-item:hover{background:#fff5f5;}
.suggestion-item img{width:32px;height:32px;border-radius:50%;object-fit:cover;}
</style>

<script>
const searchInput = document.getElementById('liveSearch');
const tableBody   = document.getElementById('tableBody');
const noResults   = document.getElementById('noResults');
const suggestions = document.getElementById('liveSuggestions');
let searchTimeout;

function filterTable() {
    const q    = searchInput.value.toLowerCase().trim();
    const rows = tableBody.querySelectorAll('tr[data-name]');
    let visible = 0;
    rows.forEach(row => {
        const matches = !q || row.dataset.name.includes(q) || row.dataset.email.includes(q);
        row.style.display = matches ? '' : 'none';
        if (matches) visible++;
    });
    noResults.style.display = visible === 0 ? 'block' : 'none';
    document.querySelector('.table-responsive').style.display = visible === 0 ? 'none' : '';
}

searchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    const q = this.value.trim();
    filterTable();
    if (q.length < 2) { suggestions.style.display = 'none'; return; }

    searchTimeout = setTimeout(() => {
        fetch(`/administrators/search?q=${encodeURIComponent(q)}`)
            .then(r => r.json())
            .then(data => {
                if (!data.length) { suggestions.style.display = 'none'; return; }
                suggestions.innerHTML = data.map(a => `
                    <div class="suggestion-item" onclick="selectSuggestion('${a.name.replace(/'/g,"\\'")}')">
                        <img src="/image/${a.image}" onerror="this.src='/img/administrator.png'">
                        <div>
                            <div class="fw-bold">${a.name}</div>
                            <div style="font-size:11px;color:#718096;">${a.email} · ${a.role}</div>
                        </div>
                    </div>
                `).join('');
                suggestions.style.display = 'block';
            }).catch(() => {});
    }, 250);
});

function selectSuggestion(name) {
    searchInput.value = name;
    suggestions.style.display = 'none';
    filterTable();
}

document.addEventListener('click', e => {
    if (!searchInput.contains(e.target) && !suggestions.contains(e.target))
        suggestions.style.display = 'none';
});

document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', e => {
        if (!confirm('Delete this administrator? Their login account will also be removed.')) e.preventDefault();
    });
});
</script>
@endsection
