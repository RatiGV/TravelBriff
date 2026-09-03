@if ($paginator->hasPages())
    <div class="room-navigation">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <img src="{{ asset('assets/images/icons/leftArrow.svg') }}" alt="Move Left" />
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><img src="{{ asset('assets/images/icons/leftArrow.svg') }}" alt="Move Left" /></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <button class="room-button active" aria-current="page">{{ $page }}</button>
                        @else
                        <a href="{{ $url }}"><button class="room-button">{{ $page }}</button></a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
              <div class="right-arrow">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><img src="{{ asset('assets/images/icons/rightArrow.svg') }}" alt="Move Right" /></a>
            </div>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <img src="{{ asset('assets/images/icons/rightArrow.svg') }}" alt="Move Right" />
                </li>
            @endif
    </div>
@endif
