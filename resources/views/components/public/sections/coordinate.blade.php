@php
    $infos = [
        [
            'icon' => 'map-pin',
            'title' => __('public/contact.info_address_title'),
            'text'  => __('public/contact.info_address'),
        ],
        [
            'icon' => 'phone',
            'title' => __('public/contact.info_phone_title'),
            'text'  => __('public/contact.info_phone'),
        ],
        [
            'icon' => 'mail',
            'title' => __('public/contact.info_email_title'),
            'text'  => __('public/contact.info_email'),
        ],
    ];
@endphp

<div class="flex flex-col gap-6">
    @foreach($infos as $index => $info)
        <div class="flex gap-4">
            <div class="w-12 h-12 shrink-0 {{ $index % 2 === 0 ? 'bg-red-strong' : 'bg-blue-strong' }} rounded-2xl flex items-center justify-center">
                <x-dynamic-component
                    :component="'icons.' . $info['icon']"
                    class="w-6 h-6 fill-white"
                />
            </div>
            <div class="flex flex-col gap-1">
                <h3 class="font-medium font-serif text-blue-strong">{{ $info['title'] }}</h3>
                <p class="font-serif text-blue-strong/300">{{ $info['text'] }}</p>
            </div>
        </div>
    @endforeach
</div>

<div class="w-full sm:w-96 p-6 bg-red-strong rounded-lg flex flex-col gap-4">
    <p class="font-sans font-medium text-white">
        {{ __('public/contact.help_title') }}
    </p>

    <a href="#" class="p-4 bg-white rounded-lg font-sans font-bold text-red-strong text-center">
        {{ __('public/contact.help_button') }}
    </a>
</div>
