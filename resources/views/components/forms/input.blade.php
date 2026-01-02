@props([
    'for' => '',
    'type' => '',
    'class_label' => '',
    'class_input' => '',
    'required' => 'false',
    'placeholder' => '',
])

<div>
    <label for="{{ $for }}" {{ $attributes->merge(['class' => $class_label]) }}>
        {{ $slot }}

        @if($required)
            <small class="{{ $class_require }}"><abbr class="text-red-normal" title="{{ __('public/form.abbr_require') }}">*</abbr></small>
        @endif
    </label>

    <input type="{{ $type }}" name="{{ $for }}" id="{{ $for }}" class="{{ $class_input }}"
    placeholder="{{ $placeholder }}">

    @error($for)
        <p class="font-serif text-sm text-red-normal mt-1">{!! $message !!}</p>
    @enderror
</div>
