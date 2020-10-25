
<div class="shop_page_nav d-flex flex-row">
@if ($paginator->hasPages())

    @if ($paginator->onFirstPage())
    <div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" ><div class="page_prev d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-left"></i></div></a>
    @endif

    <ul class="page_nav d-flex flex-row">
    @foreach ($elements as $element)

    @if (is_string($element))
    <li class="disabled"><span>{{ $element }}</span></li>
    @endif



    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    <li class="active my-active"><span>{{ $page }}</span></li>
    @else
    <li><a href="{{ $url }}">{{ $page }}</a></li>
    @endif
    @endforeach
    @endif
    @endforeach
    </ul>

    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" rel="next"><div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div></a>
    @else
    <div class="page_next d-flex flex-column align-items-center justify-content-center"><i class="fas fa-chevron-right"></i></div>
    @endif
</ul>
@endif
</div>
