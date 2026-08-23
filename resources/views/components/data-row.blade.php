@props([
    'label' => '',
])

<div {{ $attributes->merge(['class' => 'flex items-center justify-between gap-4']) }}>
    <span class="font-sans font-bold text-blue-strong">{{ $label }}</span>
    <span class="font-sans text-blue-strong text-right">{{ $slot }}</span>
</div>
