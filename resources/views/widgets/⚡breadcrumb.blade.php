<?php

use Livewire\Component;

new class extends Component
{
    public array $items = [];
};
?>

<nav aria-label="Fil d'ariane" class="flex items-center flex-wrap gap-1">
    @foreach ($items as $item)
        @if (! $loop->last)
            <x-admin-link :href="$item['url']"
               class="font-sans text-sm text-blue-strong/70 hover:text-blue-strong transition duration-200">
                {{ $item['label'] }}
            </x-admin-link>
            <x-icons.caret-right class="w-3 h-3 shrink-0 text-blue-strong/40" />
        @else
            <span class="font-sans text-sm text-blue-strong font-medium" aria-current="page">
                {{ $item['label'] }}
            </span>
        @endif
    @endforeach
</nav>
