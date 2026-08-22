@php
    $cards = [
        [
            'title' => __('public/home.values_1_title'),
            'text' => __('public/home.values_1_content'),
            'icon' => 'hand-heart',
        ],
        [
            'title' => __('public/home.values_2_title'),
            'text' => __('public/home.values_2_content'),
            'icon' => 'shield-check',
        ],
        [
            'title' => __('public/home.values_3_title'),
            'text' => __('public/home.values_3_content'),
            'icon' => 'heart',
        ],
    ]
@endphp

<x-public.sections.section class="items-center" title="{{ __('public/home.values_title') }}">
    <p class="font-sans text-xl -mt-4">{{ __('public/home.values_subtitle') }}</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
        @foreach ($cards as $card)
            <div class="bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] outline outline-1 outline-offset-[-1px] outline-blue-strong/10 p-6 flex flex-col gap-6">
                <div class="w-12 h-12 p-3 {{ $loop->iteration % 2 === 0 ? 'bg-blue-strong' : 'bg-red-strong' }} rounded-2xl flex justify-center items-center">
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
