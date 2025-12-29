@props([
    'src' => '',
    'alt' => '',
    'class' => 'rounded-lg w-full h-full object-cover'
])

<img src="{{ $src }}" alt="{{ $alt }}" {{ $attributes(['class' => $class]) }} />
