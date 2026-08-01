@props([
    'href' => '#',
    'title' => '',
    'class' => '',
    'hrefLang' => '',
])

<a href="{{ $href }}" class="{{ $class }}" title="{{ $title }}" hreflang="{{ $hrefLang }}">
    {{ $slot }}
</a>
