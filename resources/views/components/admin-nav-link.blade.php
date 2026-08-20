@props(['href', 'active' => false])

<a href="{{ $href }}" wire:navigate
   {{ $attributes->merge(['class' => 'flex items-center gap-3 px-3 py-2 rounded-lg font-serif text-blue-strong hover:bg-red-light whitespace-nowrap '.($active ? 'bg-red-light font-bold' : '')]) }}>
    {{ $slot }}
</a>
