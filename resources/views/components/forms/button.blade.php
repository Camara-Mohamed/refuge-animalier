@props([
    'type' => '',
    'title' => '',
])

<button
    type="{{ $type }}"
    title="{{ $title }}"
    {{ $attributes->merge(['class' => 'cursor-pointer flex items-center justify-center px-4 py-3 rounded-lg font-bold
    text-base
    border transition-all
    duration-200 ease-in-out']) }}
>
    {{ $slot }}
</button>
