@props([
    'title' => '',
    'image' => '',
    'imageAlt' => '',
])

<x-public.sections.section title="{{ $title }}">
    <div class="flex flex-col-reverse md:flex-row justify-between gap-8">
        <div class="flex flex-col gap-6 md:w-1/2">
            <div class="flex flex-col gap-4 font-sans font-normal text-lg text-blue-strong opacity-50">
                {{ $slot }}
            </div>

            @isset($link)
                {{ $link }}
            @endisset
        </div>

        <figure class="flex shrink-0 md:w-1/2">
            <x-public.sections.image src="{{ $image }}" alt="{{ $imageAlt }}" />
        </figure>
    </div>
</x-public.sections.section>
