@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled prev-link" aria-disabled="true">
                    <span>
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    </span>
                </li>
            @else
                <li class="prev-link active-link">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="next-link active-link">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </a>
                </li>
            @else
                <li class="disabled next-link" aria-disabled="true">
                    <span>
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
