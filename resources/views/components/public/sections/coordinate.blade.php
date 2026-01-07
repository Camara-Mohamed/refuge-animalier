@php
    $infos = [
        [
            'icon' => 'map-pin',
            'title' => __('public/contact.info_address_title'),
            'text'  => __('public/contact.info_address'),
            'color' => 'blue-strong',
        ],
        [
            'icon' => 'phone',
            'title' => __('public/contact.info_phone_title'),
            'text'  => __('public/contact.info_phone'),
            'color' => 'red-strong',
        ],
        [
            'icon' => 'mail',
            'title' => __('public/contact.info_email_title'),
            'text'  => __('public/contact.info_email'),
            'color' => 'blue-turquoise',
        ],
        [
            'icon' => 'clock',
            'title' => __('public/contact.info_hours_title'),
            'text'  => __('public/contact.info_hours'),
            'color' => 'red-normal',
        ],
    ];

    $bgColors = [
        'blue-strong' => 'bg-blue-strong/10',
        'red-strong' => 'bg-red-strong/10',
        'blue-turquoise' => 'bg-blue-turquoise/10',
        'red-normal' => 'bg-red-normal/10',
    ];

    $fillColors = [
        'blue-strong' => 'fill-blue-strong',
        'red-strong' => 'fill-red-strong',
        'blue-turquoise' => 'fill-blue-turquoise',
        'red-normal' => 'fill-red-normal',
    ];
@endphp

<div class="flex flex-col gap-6">
    @foreach($infos as $info)
        <div class="flex gap-4">
            <div class="w-12 h-12 {{ $bgColors[$info['color']] }} rounded-2xl flex items-center justify-center">
                <x-dynamic-component
                    :component="'icons.' . $info['icon']"
                    class="{{ $fillColors[$info['color']] }}"
                />
            </div>
            <div class="flex flex-col gap-1">
                <h3 class="font-medium font-serif text-blue-strong">{{ $info['title'] }}</h3>
                <p class="font-serif text-blue-strong/300">{{ $info['text'] }}</p>
            </div>
        </div>
    @endforeach
</div>
