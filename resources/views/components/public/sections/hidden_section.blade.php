@props([
    'title' => '',
])

<section {{ $attributes->merge(['class' => 'py-10 px-6 md:py-12 md:px-12 lg:py-16 lg:px-20 flex flex-col text-blue-strong transition-all duration-300 ease-in-out']) }}>
    <h2 class="sr-only">
        {{ $title}}
    </h2>
    {{ $slot }}
</section>
