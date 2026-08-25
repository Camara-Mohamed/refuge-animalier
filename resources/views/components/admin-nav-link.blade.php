@props(['href', 'active' => false])

<a href="{{ $href }}" wire:navigate
   {{ $attributes->merge(['class' => 'flex items-center gap-3 px-3 py-1.5 lg:py-2 rounded-lg font-serif text-white/80 hover:bg-white/10 hover:text-white whitespace-nowrap '.($active ? 'bg-white/15 font-bold text-white' : '')]) }}>
    {{ $slot }}
</a>
