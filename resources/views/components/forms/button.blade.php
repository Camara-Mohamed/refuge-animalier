@props([
    'type' => '',
    'title' => '',
])

<button
    type="{{ $type }}"
    title="{{ $title }}"
    {{ $attributes->merge(['class' => '']) }}
>
    {{ $slot }}
</button>
