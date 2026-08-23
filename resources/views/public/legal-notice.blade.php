<x-layouts.guest title="{{ __('public/legal.title') }}" :schema="[
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => __('public/legal.page_title'),
    'url' => route('public.legal-notice', app()->getLocale()),
]">

    <x-public.sections.intro title="{{ __('public/legal.page_title') }}">
        {{ __('public/legal.page_subtitle') }}
    </x-public.sections.intro>

    <section class="pb-16 px-6 md:px-12 lg:px-20 flex flex-col gap-10 text-blue-strong max-w-3xl">
        <div class="flex flex-col gap-3">
            <h2 class="font-serif font-bold text-2xl">{{ __('public/legal.editor_title') }}</h2>
            <p class="font-sans opacity-70">
                {{ __('public/legal.editor_association') }} {{ __('public/legal.editor_association_name') }}
            </p>
            <p class="font-sans opacity-70">
                {{ __('public/legal.editor_contact') }}
                <a href="{{ route('public.contact', app()->getLocale()) }}" class="underline hover:text-red-strong">
                    {{ __('public/legal.editor_contact_link') }}
                </a>
            </p>
        </div>

        <div class="flex flex-col gap-3">
            <h2 class="font-serif font-bold text-2xl">{{ __('public/legal.hosting_title') }}</h2>
            <p class="font-sans opacity-70">{{ __('public/legal.hosting_content') }}</p>
        </div>

        <div class="flex flex-col gap-3">
            <h2 class="font-serif font-bold text-2xl">{{ __('public/legal.ip_title') }}</h2>
            <p class="font-sans opacity-70">{{ __('public/legal.ip_content') }}</p>
        </div>

        <div class="flex flex-col gap-3">
            <h2 class="font-serif font-bold text-2xl">{{ __('public/legal.data_title') }}</h2>
            <p class="font-sans opacity-70">{!! __('public/legal.data_content') !!}</p>
        </div>

        <div class="flex flex-col gap-3">
            <h2 class="font-serif font-bold text-2xl">{{ __('public/legal.cookies_title') }}</h2>
            <p class="font-sans opacity-70">{{ __('public/legal.cookies_content') }}</p>
        </div>

        <div class="flex flex-col gap-3">
            <h2 class="font-serif font-bold text-2xl">{{ __('public/legal.liability_title') }}</h2>
            <p class="font-sans opacity-70">{{ __('public/legal.liability_content') }}</p>
        </div>

        <div class="flex flex-col gap-3">
            <h2 class="font-serif font-bold text-2xl">{{ __('public/legal.law_title') }}</h2>
            <p class="font-sans opacity-70">{{ __('public/legal.law_content') }}</p>
        </div>
    </section>

</x-layouts.guest>
