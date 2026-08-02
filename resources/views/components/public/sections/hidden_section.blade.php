@props([
    'title' => '',
])

<section {{ $attributes->merge(['class' => 'py-16 px-20 flex flex-col text-blue-strong transition-all duration-300 ease-in-out']) }}>
    <h2 class="sr-only">
        {{ $title}}
    </h2>
    {{ $slot }}
</section>
