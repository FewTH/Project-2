@if ($paginator->hasPages())
<nav class="pager" role="navigation" aria-label="Pagination">
    <ul class="pager-list">
        {{-- ปุ่ม Previous --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><span>&lsaquo; Previous</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo; Previous</a></li>
        @endif

        {{-- ตัวเลขหน้า --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- ปุ่ม Next --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next &rsaquo;</a></li>
        @else
            <li class="disabled"><span>Next &rsaquo;</span></li>
        @endif
    </ul>
</nav>
@endif