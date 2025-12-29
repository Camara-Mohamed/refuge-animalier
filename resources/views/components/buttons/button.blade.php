@props([
    'href' => '#',
    'title' => '',
    'base' => 'flex items-center justify-center px-4 py-3 rounded-lg font-bold text-base border transition-all
    duration-200 ease-in-out',
])

<a
    href="{{ $href }}"
    title="{{ $title }}"
    {{ $attributes(['class' => $base]) }}
>
    {{ $slot }}
</a>
