@props([
    'vaccines' => [],
])

<ul {{ $attributes->merge(['class' => 'flex gap-2 flex-wrap']) }}>
    @foreach ($vaccines as $vaccine)
        <li class="px-3 py-2 rounded-lg border text-sm
                odd:border-red-strong odd:bg-red-strong/5 odd:text-red-strong
                even:border-blue-strong even:bg-blue-strong/5 even:text-blue-strong">
            {{ $vaccine->name }}
        </li>
    @endforeach
</ul>
