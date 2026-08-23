@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex flex-wrap items-center justify-center gap-2 font-sans">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}"
                  class="w-9 h-9 flex items-center justify-center rounded-lg border border-blue-strong/20 text-blue-strong/30 cursor-not-allowed">
                <x-icons.arrow-left class="w-4 h-4" fill="fill-current" />
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}"
               class="w-9 h-9 flex items-center justify-center rounded-lg border border-red-strong text-red-strong hover:bg-red-strong hover:text-white transition-colors duration-200">
                <x-icons.arrow-left class="w-4 h-4" fill="fill-current" />
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span aria-disabled="true" class="w-9 h-9 flex items-center justify-center text-blue-strong/70">
                    {{ $element }}
                </span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page"
                              class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-strong text-white font-bold text-sm">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                           class="w-9 h-9 flex items-center justify-center rounded-lg text-sm text-blue-strong hover:bg-red-light transition-colors duration-200">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}"
               class="w-9 h-9 flex items-center justify-center rounded-lg border border-red-strong text-red-strong hover:bg-red-strong hover:text-white transition-colors duration-200">
                <x-icons.arrow-right class="w-4 h-4" fill="fill-current" />
            </a>
        @else
            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}"
                  class="w-9 h-9 flex items-center justify-center rounded-lg border border-blue-strong/20 text-blue-strong/30 cursor-not-allowed">
                <x-icons.arrow-right class="w-4 h-4" fill="fill-current" />
            </span>
        @endif
    </nav>
@endif
