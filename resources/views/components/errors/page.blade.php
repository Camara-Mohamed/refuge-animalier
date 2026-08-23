@props([
    'code' => '',
    'title' => '',
    'message' => '',
])

<x-layouts.guest title="{{ $code }} - {{ __('public/home.name_website') }}">
    <section class="min-h-[60vh] flex flex-col items-center justify-center text-center px-6 py-20 gap-6">
        <p class="font-serif font-black text-red-strong text-7xl">{{ $code }}</p>

        <div class="flex flex-col gap-2 max-w-md">
            <h1 class="font-serif font-bold text-2xl text-blue-strong">{{ $title }}</h1>
            <p class="font-sans text-blue-strong/60">{{ $message }}</p>
        </div>

        <x-buttons.button
            href="{{ route('public.home', app()->getLocale()) }}"
            class="bg-red-strong border-red-strong text-white hover:bg-white hover:text-red-strong hover:border-red-strong"
        >
            {{ __('public/errors.back_home') }}
        </x-buttons.button>
    </section>
</x-layouts.guest>
