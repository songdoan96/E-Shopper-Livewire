<div>
  @if ($paginator->hasPages())
    <ul role="navigation" aria-label="Pagination Navigation" class="pagination">
      <li>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
          <span class="last-page">
            <i class="fa fa-chevron-left"></i>
          </span>
        @else
          <a wire:click="previousPage" wire:loading.attr="disabled" rel="prev">
            <i class="fa fa-chevron-left"></i>
          </a>
        @endif
      </li>
      @foreach ($elements as $element)

        @if (is_string($element))
          <li><span>{{ $element }}</span></li>
        @endif

        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <li class="active"><span>{{ $page }}</span></li>
            @else
              <li><a wire:click="gotoPage({{ $page }})">{{ $page }}</a></li>
            @endif
          @endforeach
        @endif
      @endforeach

      <li>
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          <a wire:click="nextPage" wire:loading.attr="disabled" rel="next">
            <i class="fa fa-chevron-right"></i>
          </a>
        @else
          <span class="last-page">
            <i class="fa fa-chevron-right"></i>
          </span>
        @endif
      </li>
    </ul>
  @endif
</div>
