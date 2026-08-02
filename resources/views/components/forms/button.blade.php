@props([
    'type' => '',
    'title' => '',
    'class' => '',
])

<button
    type="{{ $type }}"
    title="{{ $title }}"
    {{ $attributes->merge(['class' => $class]) }}
>
    {{ $slot }}
</button>
