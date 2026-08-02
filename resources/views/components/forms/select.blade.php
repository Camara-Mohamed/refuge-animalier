@props([
    'for' => '',
    'id' => '',
    'class_label' => '',
    'class_select' => '',
])

<div>
    <label for="{{ $for }}" {{ $attributes->merge(['class' => $class_label]) }}>{{ $label }}</label>

    <select name="{{ $for }}" id="{{ $id }}" {{ $attributes->merge(['class' => $class_select]) }}>
        {{ $slot }}
    </select>
</div>
