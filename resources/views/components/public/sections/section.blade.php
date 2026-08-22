@props([
    'title' => '',
])

<section {{ $attributes->merge(['class' => 'py-10 px-6 md:py-12 md:px-12 lg:py-16 lg:px-20 flex flex-col gap-8 text-blue-strong transition-all duration-300 ease-in-out']) }}>
    <h2 class="font-serif font-bold text-2xl md:text-3xl lg:text-4xl max-w-2xl">
        {{ $title}}
    </h2>
    {{ $slot }}
</section>
