@props([
    'label_title' => '',
    'for' => '',
])

<div class="flex justify-between items-center">
    <label for="{{ $for }}" class="sr-only">{{ $label_title }}</label>

    <select name="{{ $for }}" id="{{ $for }}" {{ $attributes->merge(['class' => 'px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-red-strong focus:border-2']) }}>
        {{ $slot }}
    </select>
</div>
