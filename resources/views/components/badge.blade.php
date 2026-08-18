@props(['color' => 'bg-gray-100 text-gray-700'])

<span {{ $attributes->merge(['class' => "inline-flex items-center px-3 py-1 rounded-full font-sans text-xs font-semibold $color"]) }}>
    {{ $slot }}
</span>
