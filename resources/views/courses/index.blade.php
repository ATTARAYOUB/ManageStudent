@extends('layout')
@section('title', 'Courses List')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-0" style="color:#1a202c;">
            <i class="fas fa-book-open me-2" style="color:#2B6CB0;"></i>Courses
        </h4>
        <small class="text-muted" id="resultCount">{{ $courses->total() }} course(s) found</small>
    </div>
    <div class="d-flex gap-2">
        @if(auth()->user()->isAdmin())
        <a href="{{ url('/courses/create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-plus me-1"></i> Add Course
        </a>
        @endif
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-danger"><i class="fas fa-times-circle me-2"></i>{{ session('error') }}</div>
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
                       placeholder="Type name, room or schedule..."
                       value="{{ request('search') }}"
                       autocomplete="off">
            </div>
            <div id="liveSuggestions" style="position:absolute;z-index:1000;background:#fff;border:2px solid #e2e8f0;border-radius:10px;box-shadow:0 8px 24px rgba(0,0,0,.1);left:0;right:0;top:100%;margin-top:4px;display:none;max-height:280px;overflow-y:auto;"></div>
        </div>
        <div class="col-md-2">
            <a href="{{ url('/courses') }}" class="btn btn-outline-secondary w-100">
                <i class="fas fa-times me-1"></i> Clear
            </a>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th>#</th><th>Name</th><th>Schedule</th><th>Room</th><th>Teacher</th><th>Students</th><th>Actions</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @forelse($courses as $course)
            <tr data-name="{{ strtolower($course->name) }}" data-room="{{ strtolower($course->room) }}" data-schedule="{{ strtolower($course->schedule) }}">
                <td class="text-muted fw-bold">{{ $course->id }}</td>
                <td class="fw-bold">{{ $course->name }}</td>
                <td><i class="fas fa-clock me-1" style="color:#2B6CB0;"></i>{{ $course->schedule }}</td>
                <td><i class="fas fa-door-open me-1" style="color:#718096;"></i>{{ $course->room }}</td>
                <td>
                    @if($course->teacher)
                        <span class="badge" style="background:#F0FFF4;color:#276749;font-size:11px;padding:5px 10px;border-radius:20px;">{{ $course->teacher->name }}</span>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td><span class="fw-bold" style="color:#2B6CB0;">{{ $course->students_count }}</span></td>
                <td>
                    <div class="d-flex gap-1">
                        <a class="btn btn-sm btn-info" href="{{ route('courses.show', $course->id) }}" title="View"><i class="fas fa-eye"></i></a>
                        @if(auth()->user()->isAdmin())
                        <a class="btn btn-sm btn-primary" href="{{ route('courses.edit', $course->id) }}" title="Edit"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('courses.destroy', $course->id) }}" class="delete-form">
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
                    <i class="fas fa-book-open fa-3x mb-3 d-block" style="opacity:.2;"></i>No courses found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="noResults" class="text-center py-5 text-muted" style="display:none;">
    <i class="fas fa-search fa-3x mb-3 d-block" style="opacity:.2;"></i>
    No courses match your search.
</div>

<div class="d-flex justify-content-between align-items-center mt-4 px-1">
    <div style="font-size:13px;color:#718096;font-weight:600;">
        <i class="fas fa-list me-1" style="color:#2B6CB0;"></i>
        Showing <strong>{{ $courses->firstItem() }}</strong>–<strong>{{ $courses->lastItem() }}</strong> of <strong>{{ $courses->total() }}</strong> courses
    </div>
    {{ $courses->links() }}
</div>

<style>
@keyframes slideUp{from{transform:translateY(30px);opacity:0}to{transform:translateY(0);opacity:1}}
.suggestion-item{padding:10px 14px;cursor:pointer;display:flex;align-items:center;gap:10px;border-bottom:1px solid #f0f0f0;font-size:13px;}
.suggestion-item:hover{background:#fffff0;}
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
        const matches = !q || row.dataset.name.includes(q) || row.dataset.room.includes(q) || row.dataset.schedule.includes(q);
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
        fetch(`/courses/search?q=${encodeURIComponent(q)}`)
            .then(r => r.json())
            .then(data => {
                if (!data.length) { suggestions.style.display = 'none'; return; }
                suggestions.innerHTML = data.map(c => `
                    <div class="suggestion-item" onclick="selectSuggestion('${c.name.replace(/'/g,"\\'")}')">
                        <div style="width:32px;height:32px;background:#FFFFF0;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#744210;">
                            <i class="fas fa-book-open" style="font-size:13px;"></i>
                        </div>
                        <div>
                            <div class="fw-bold">${c.name}</div>
                            <div style="font-size:11px;color:#718096;">${c.schedule} · Room ${c.room}${c.teacher ? ' · ' + c.teacher : ''}</div>
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
        if (!confirm('Delete this course? All enrollments will be removed too.')) e.preventDefault();
    });
});
</script>
@endsection
