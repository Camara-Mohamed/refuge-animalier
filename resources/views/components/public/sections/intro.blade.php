@props([
    'title' => '',
])

<x-public.sections.section title="{{ $title }}">
    <p class="font-sans font-normal text-lg text-blue-strong opacity-50 max-w-2xl">
        {{ $slot }}
    </p>
</x-public.sections.section>
