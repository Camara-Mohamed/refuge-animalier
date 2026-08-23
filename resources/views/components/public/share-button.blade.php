@props([
    'url' => '',
    'subject' => '',
    'body' => '',
])

<a
    href="mailto:?subject={{ $subject }}&body={{ $body }} {{ $url }}"
    {{ $attributes->merge(['class' => 'group flex items-center gap-2 p-4 rounded-lg bg-white text-red-strong hover:bg-red-strong hover:text-white transition-colors duration-200 font-sans font-bold text-base']) }}
>
    <x-icons.share-network class="w-5 h-5 fill-red-strong group-hover:fill-white transition-colors duration-200" />
    <span>{{ $slot }}</span>
</a>
