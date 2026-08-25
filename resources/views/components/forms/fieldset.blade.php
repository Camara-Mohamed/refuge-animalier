@props([
    'title' => '',
])

<fieldset {{ $attributes->merge(['class' => 'flex flex-col gap-4 border border-red-strong rounded-lg px-4 pb-4 min-w-0']) }}>
    <legend class="px-3 -ml-3 mb-4 font-serif font-bold text-red-strong">{{ $title }}</legend>
    {{ $slot }}
</fieldset>
