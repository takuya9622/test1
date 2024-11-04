@if ($paginator->hasPages())
    @php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
    @endphp
    <nav aria-label="Pagination Navigation">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            <li class="{{ $paginator->onFirstPage() ? 'disabled' : '' }}" aria-disabled="{{ $paginator->onFirstPage() ? 'true' : 'false' }}">
                @if ($paginator->onFirstPage())
                    <span aria-hidden="true">&lt;</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Previous Page">&lt;</a>
                @endif
            </li>

            {{-- Always show the first page --}}
            <li class="{{ $currentPage == 1 ? 'active' : '' }}" aria-current="{{ $currentPage == 1 ? 'page' : 'false' }}">
                @if ($currentPage == 1)
                    <span>1</span>
                @else
                    <a href="{{ $paginator->url(1) }}">1</a>
                @endif
            </li>

            {{-- Show dots if needed before the current range --}}
            @if ($currentPage > 4)
                <li class="disabled" aria-disabled="true"><span>...</span></li>
            @endif

            {{-- Show pages around the current page --}}
            @for ($i = max(2, $currentPage - 2); $i <= min($lastPage - 1, $currentPage + 2); $i++)
                @if ($i != 1 && $i != $lastPage) {{-- Skip already shown first and last page --}}
                    <li class="{{ $i == $currentPage ? 'active' : '' }}" aria-current="{{ $i == $currentPage ? 'page' : 'false' }}">
                        @if ($i == $currentPage)
                            <span>{{ $i }}</span>
                        @else
                            <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                        @endif
                    </li>
                @endif
            @endfor

            {{-- Show dots if needed after the current range --}}
            @if ($currentPage < $lastPage - 3)
                <li class="disabled" aria-disabled="true"><span>...</span></li>
            @endif

            {{-- Display the last page --}}
            @if ($lastPage > 1)
                <li class="{{ $currentPage == $lastPage ? 'active' : '' }}" aria-current="{{ $currentPage == $lastPage ? 'page' : 'false' }}">
                    @if ($currentPage == $lastPage)
                        <span>{{ $lastPage }}</span>
                    @else
                        <a href="{{ $paginator->url($lastPage) }}">{{ $lastPage }}</a>
                    @endif
                </li>
            @endif

            {{-- Next Page Link --}}
            <li class="{{ $paginator->hasMorePages() ? '' : 'disabled' }}" aria-disabled="{{ $paginator->hasMorePages() ? 'false' : 'true' }}">
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next Page">&gt;</a>
                @else
                    <span aria-hidden="true">&gt;</span>
                @endif
            </li>
        </ul>
    </nav>
@endif
