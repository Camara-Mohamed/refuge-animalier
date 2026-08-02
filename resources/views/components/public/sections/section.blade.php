@props([
    'title' => '',
])

<section {{ $attributes->merge(['class' => 'py-16 px-20 flex flex-col gap-8 text-blue-strong transition-all duration-300 ease-in-out']) }}>
    <h2 class="font-serif font-bold text-4xl">
        {{ $title}}
    </h2>
    {{ $slot }}
</section>
