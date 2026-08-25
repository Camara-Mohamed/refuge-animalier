@props([
    'title' => '',
    'image' => '',
    'imageAlt' => '',
])

<x-public.sections.section title="{{ $title }}">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="flex flex-col gap-6 order-2 md:order-1">
            <div class="flex flex-col gap-4 font-sans font-normal text-lg text-blue-strong opacity-70">
                {{ $slot }}
            </div>

            @isset($link)
                {{ $link }}
            @endisset
        </div>

        <figure class="order-1 md:order-2 h-full min-h-64">
            <x-public.sections.image src="{{ $image }}" alt="{{ $imageAlt }}" />
        </figure>
    </div>
</x-public.sections.section>
