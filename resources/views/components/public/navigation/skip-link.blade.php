@props([
    'href' => '#main-content',
])

<a href="{{ $href }}"
   class="sr-only focus:not-sr-only font-serif text-blue-strong underline hover:text-red-normal">
    {{ $slot->isEmpty() ? 'Aller au contenu principal' : $slot }}
</a>
