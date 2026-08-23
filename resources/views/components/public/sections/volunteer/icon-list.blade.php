@props([
    'items' => [],
])

<div {{ $attributes->merge(['class' => 'flex flex-col gap-4']) }}>
    @foreach ($items as $index => $item)
        <div class="p-6 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] outline outline-1 outline-offset-[-1px] outline-blue-strong/10 flex gap-6 items-start">
            <div class="w-12 h-12 shrink-0 p-3 {{ $index % 2 === 1 ? 'bg-blue-strong' : 'bg-red-strong' }} rounded-2xl flex justify-center items-center">
                <x-dynamic-component :component="'icons.' . $item['icon']" class="fill-white" />
            </div>
            <div class="flex flex-col gap-2">
                <h4 class="font-serif font-bold text-base text-blue-strong">{{ $item['title'] }}</h4>
                <p class="font-sans text-base text-blue-strong opacity-70">{{ $item['text'] }}</p>
            </div>
        </div>
    @endforeach
</div>
