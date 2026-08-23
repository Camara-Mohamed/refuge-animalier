@props([
    'items' => [],
])

<div {{ $attributes->merge(['class' => 'grid grid-cols-1 md:grid-cols-2 gap-6']) }}>
    @foreach ($items as $index => $item)
        <div class="flex gap-4 p-6 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] outline outline-1 outline-offset-[-1px] outline-blue-strong/10">
            <div class="w-10 h-10 bg-red-strong rounded-full flex items-center justify-center flex-shrink-0">
                <span class="text-white font-bold">{{ $index + 1 }}</span>
            </div>
            <div class="flex flex-col gap-2">
                <h3 class="text-lg font-bold text-blue-strong">{{ $item['title'] }}</h3>
                <p class="text-blue-strong opacity-70">{{ $item['text'] }}</p>
            </div>
        </div>
    @endforeach
</div>
