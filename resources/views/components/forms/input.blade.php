@props([
    'for' => '',
    'type' => '',
    'class_label' => 'font-medium font-serif',
    'class_input' => 'px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-red-strong focus:border-2',
    'required' => false,
    'placeholder' => '',
    'value' => null,
])

<div class="flex flex-col gap-2">
    <label for="{{ $for }}" class="{{ $class_label }}">
        {{ $slot }}

        @if($required)
            <small><abbr class="text-red-normal" title="{{ __('public/form.abbr_require') }}">*</abbr></small>
        @endif
    </label>

    <input @if($required) required @endif type="{{ $type }}" value="{{ old($for, $value) }}" name="{{ $for }}" id="{{ $for }}"
    placeholder="{{ $placeholder }}" {{ $attributes->merge(['class' => $class_input]) }}>

    @error($for)
        <p class="font-serif text-sm text-red-normal mt-1">{!! $message !!}</p>
    @enderror
</div>
