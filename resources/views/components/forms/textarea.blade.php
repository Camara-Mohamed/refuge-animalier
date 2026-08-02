@props([
    'for' => '',
    'class_label' => 'font-medium font-serif',
    'class_area' => 'px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-red-strong focus:border-2',
    'required' => false,
    'placeholder' => '',
])

<div class="flex flex-col gap-2 font-medium">
    <label for="{{ $for }}" {{ $attributes->merge(['class' => $class_label]) }}>
        {{ $slot }}

        @if($required)
            <small>
                <abbr class="text-red-normal" title="{{ __('public/form.abbr_require') }}">*</abbr>
            </small>
        @endif
    </label>

    <textarea
        name="{{ $for }}"
        id="{{ $for }}"
        class="{{ $class_area }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        rows="8"
    >{{ old($for) }}</textarea>

    @error($for)
    <p class="font-serif text-sm text-red-normal mt-1">{!! $message !!}</p>
    @enderror
</div>
