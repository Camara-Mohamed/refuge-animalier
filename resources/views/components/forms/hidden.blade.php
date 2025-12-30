@props([
    'for' => '',
    'type' => '',
    'class_label' => 'sr-only',
    'class_input' => 'px-6 py-4 rounded-lg border-2 border-gray-300 placeholder:font-sans
    placeholder:font-normal
    placeholder:text-gray-400 hover:border-gray-500 hover:placeholder:text-gray-500 focus:border-red-strong
    focus:text-blue-strong focus:outline-none',
    'placeholder' => '',
])

<div class="max-w-24 min-w-12">
    <label for="{{ $for }}" class="{{ $class_label }}">
        {{ $slot }}
    </label>

    <input type="{{ $type }}" name="{{ $for }}" id="{{ $for}}" {{ $attributes->merge(['class' => $class_input]) }}
    placeholder="{{ $placeholder }}">
</div>
