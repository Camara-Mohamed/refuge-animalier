@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('pagination.navigation') }}" class="flex flex-wrap items-center justify-center gap-2 font-sans">
        <h3 class="sr-only">{{ __('pagination.navigation') }}</h3>

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}"
                  class="w-9 h-9 flex items-center justify-center rounded-lg border border-blue-strong/20 text-blue-strong/30 cursor-not-allowed">
                <x-icons.arrow-left class="w-4 h-4" fill="fill-current" />
            </span>
        @else
            <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                    aria-label="{{ __('pagination.previous') }}" title="{{ __('pagination.previous') }}"
                    class="w-9 h-9 flex items-center justify-center rounded-lg border border-red-strong text-red-strong hover:bg-red-strong hover:text-white transition-colors duration-200">
                <x-icons.arrow-left class="w-4 h-4" fill="fill-current" />
            </button>
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
                        <span aria-current="page" wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}"
                              class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-strong text-white font-bold text-sm">
                            {{ $page }}
                        </span>
                    @else
                        <button type="button" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}"
                                aria-label="{{ __('Go to page :page', ['page' => $page]) }}" title="{{ __('Go to page :page', ['page' => $page]) }}"
                                class="w-9 h-9 flex items-center justify-center rounded-lg text-sm text-blue-strong hover:bg-red-light transition-colors duration-200">
                            {{ $page }}
                        </button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                    aria-label="{{ __('pagination.next') }}" title="{{ __('pagination.next') }}"
                    class="w-9 h-9 flex items-center justify-center rounded-lg border border-red-strong text-red-strong hover:bg-red-strong hover:text-white transition-colors duration-200">
                <x-icons.arrow-right class="w-4 h-4" fill="fill-current" />
            </button>
        @else
            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}"
                  class="w-9 h-9 flex items-center justify-center rounded-lg border border-blue-strong/20 text-blue-strong/30 cursor-not-allowed">
                <x-icons.arrow-right class="w-4 h-4" fill="fill-current" />
            </span>
        @endif
    </nav>
@endif
