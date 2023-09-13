<div class="pagination justify-content-end">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
        <span class="page-item disabled"><span class="page-link">Previous</span></span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev">Previous</a>
    @endif

    {{-- Pagination Elements --}}
    @if ($paginator->lastPage() > 1)
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            @if ($i === 1 || $i === $paginator->lastPage() || ($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2))
                @if ($paginator->currentPage() === $i)
                    <span class="page-item active"><span class="page-link">{{ $i }}</span></span>
                @else
                    <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
                @endif
            @elseif (($i === $paginator->currentPage() - 3 && $i > 2) || ($i === $paginator->currentPage() + 3 && $i < $paginator->lastPage() - 1))
                <span class="page-item disabled"><span class="page-link">...</span></span>
            @endif
        @endfor
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next">Next</a>
    @else
        <span class="page-item disabled"><span class="page-link">Next</span></span>
    @endif
</div>
