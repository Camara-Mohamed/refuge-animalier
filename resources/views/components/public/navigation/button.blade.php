@props([
    'href' => '#',
    'title' => '',
    'class' => '',
])

<a href="{{ $href }}" class="{{ $class }}" title="{{ $title }}">
    {{ $slot }}
</a>
