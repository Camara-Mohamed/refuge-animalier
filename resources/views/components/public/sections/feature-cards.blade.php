@props([
    'title' => '',
    'subtitle' => '',
    'cards' => [],
])

<x-public.sections.section class="items-center" title="{{ $title }}">
    @if ($subtitle)
        <p class="font-sans text-xl -mt-4">{{ $subtitle }}</p>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
        @foreach ($cards as $index => $card)
            <div class="bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] outline outline-1 outline-offset-[-1px] outline-blue-strong/10 p-6 flex flex-col gap-6">
                <div class="w-12 h-12 p-3 {{ $index % 2 === 1 ? 'bg-blue-strong' : 'bg-red-strong' }} rounded-2xl flex justify-center items-center">
                    <x-dynamic-component
                        :component="'icons.' . $card['icon']"
                        class="fill-white" />
                </div>

                <div class="flex flex-col gap-4">
                    <h3 class="font-serif font-bold text-base">
                        {{ $card['title'] }}
                    </h3>

                    <p class="font-sans font-normal text-base">
                        {{ $card['text'] }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</x-public.sections.section>
