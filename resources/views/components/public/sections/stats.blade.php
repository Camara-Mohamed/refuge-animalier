@php
    $cards = [
        [
            'stat_title' => __('public/home.stats_number_1'),
            'stat_text' => __('public/home.stats_number_1_content'),
            'icon' => 'users',
        ],
        [
            'stat_title' => __('public/home.stats_number_2'),
            'stat_text' => __('public/home.stats_number_2_content'),
            'icon' => 'users',
        ],
                [
            'stat_title' => __('public/home.stats_number_3'),
            'stat_text' => __('public/home.stats_number_3_content'),
            'icon' => 'users',
        ],
        [
            'stat_title' => __('public/home.stats_number_4'),
            'stat_text' => __('public/home.stats_number_4_content'),
            'icon' => 'users',
        ],
     ]
@endphp

<x-public.sections.section title="{{ __('public/home.stats_title') }}">
    <div class="grid grid-cols-4 gap-6 text-center font-serif">

        @foreach ($cards as $card)
            <div class="bg-white rounded-lg shadow-lg p-8 flex flex-col items-center gap-2">

                <div class="p-4 bg-blue-strong rounded-2xl flex justify-center items-center">
                    <x-dynamic-component
                        :component="'icons.' . $card['icon']"
                        class="fill-white" />
                </div>

                <h3 class="text-2xl font-bold mt-4">
                    {{ $card['stat_title'] }}
                </h3>

                <p class="font-normal">
                    {{ $card['stat_text'] }}
                </p>
            </div>
        @endforeach
    </div>

</x-public.sections.section>
