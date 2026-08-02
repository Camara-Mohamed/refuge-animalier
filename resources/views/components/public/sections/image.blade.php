@props([
    'src' => '',
    'alt' => '',
])

<img src="{{ $src }}" alt="{{ $alt }}" {{ $attributes->merge(['class' => 'rounded-lg w-full h-full object-cover']) }} />
