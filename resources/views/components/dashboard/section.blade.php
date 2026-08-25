@props(['title', 'term' => null, 'placeholder' => 'Rechercher...'])

<div class="flex flex-col gap-2">
    <div class="flex items-center justify-between gap-4 flex-wrap">
        <h2 class="font-serif font-bold text-lg text-blue-strong">{{ $title }}</h2>

        @if ($term)
            <input type="text" wire:model.live.debounce.300ms="{{ $term }}"
                   placeholder="{{ $placeholder }}"
                   class="px-4 py-2 rounded-lg border border-gray-200 font-sans text-sm text-blue-strong placeholder:text-blue-strong/40 focus:outline-none focus:border-red-strong">
        @endif
    </div>

    <div class="overflow-x-auto">
        {{ $slot }}
    </div>
</div>
