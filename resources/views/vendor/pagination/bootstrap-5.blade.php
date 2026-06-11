@if ($paginator->hasPages())
<nav aria-label="Pagination" class="school-pagination">
    <ul class="pagination-list">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-btn prev-btn">
                    <i class="fas fa-chevron-left"></i> Prev
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-btn prev-btn" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous">
                    <i class="fas fa-chevron-left"></i> Prev
                </a>
            </li>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-btn dots">{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-btn current" aria-current="page">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-btn" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-btn next-btn" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next">
                    Next <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-btn next-btn">
                    Next <i class="fas fa-chevron-right"></i>
                </span>
            </li>
        @endif

    </ul>
</nav>
@endif
