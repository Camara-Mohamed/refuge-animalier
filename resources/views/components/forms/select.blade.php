@props([
    'label_title' => '',
    'for' => '',
    'class_label' => 'sr-only',
    'class_select' => 'px-6 py-4 rounded-lg border-2 border-gray-300 font-sans
    font-normal text-gray-400 hover:border-gray-500 hover:text-gray-500 focus:border-red-strong
    focus:text-blue-strong focus:outline-none',
])

<div class="flex justify-between items-center">
    <label for="{{ $for }}" class="{{ $class_label }}">{{ $label_title }}</label>

    <select name="{{ $for }}" id="{{ $for }}" {{ $attributes->merge(['class' => $class_select]) }}>
        {{ $slot }}
    </select>
</div>
