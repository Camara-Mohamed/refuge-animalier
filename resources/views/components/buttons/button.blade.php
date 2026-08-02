@props([
    'href' => '#',
    'title' => '',
])

<a
    href="{{ $href }}"
    title="{{ $title }}"
    {{ $attributes->merge(['class' => 'flex items-center justify-center px-4 py-3 rounded-lg font-bold text-base border transition-all
    duration-200 ease-in-out']) }}
>
    {{ $slot }}
</a>
