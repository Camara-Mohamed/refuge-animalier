@props([
    'url' => '',
    'subject' => '',
    'body' => '',
])

<a
    href="mailto:?subject={{ $subject }}&body={{ $body }} {{ $url }}"
    {{ $attributes->merge(['class' => 'flex items-center gap-2 px-4 py-2 rounded-lg border border-white/40 text-white hover:bg-white/10 font-sans text-sm']) }}
>
    <x-icons.share-network class="w-5 h-5" />
    <span>{{ $slot }}</span>
</a>
