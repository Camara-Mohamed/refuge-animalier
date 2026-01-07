@props([
    'for' => '',
    'type' => '',
    'placeholder' => '',
])

<div class="flex flex-col gap-2">
    <label for="{{ $for }}" class="sr-only">
        {{ $slot }}
    </label>

    <input type="{{ $type }}" name="{{ $for }}" id="{{ $for}}" {{ $attributes->merge(['class' => 'px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-red-strong focus:border-2']) }}
    placeholder="{{ $placeholder }}">
</div>
