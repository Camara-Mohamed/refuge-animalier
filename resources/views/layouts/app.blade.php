<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Camara Mohamed">
    <meta name="description" content="{{ __('admin/layout.meta_description') }}">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ ($title ?? __('admin/layout.title_fallback')) . ' - Les Pattes Heureuses' }}</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="min-h-screen font-sans bg-white">

<x-public.navigation.no-script/>

<h1 class="sr-only">{{ $title ?? __('admin/layout.title_fallback') }}</h1>

<x-public.navigation.skip-link/>

<div class="flex min-h-screen">
    <aside class="w-80 shrink-0 bg-red-strong flex flex-col sticky top-0 h-screen overflow-y-auto p-6">
        <div class="flex items-center justify-center py-6">
            <h2 class="sr-only">Les Pattes Heureuses</h2>
            <x-admin-link :href="route('admin.dashboard', ['locale' => app()->getLocale()])"
                          class="font-sans font-black text-xl leading-6 text-white text-center whitespace-nowrap">
                Les Pattes Heureuses
            </x-admin-link>
        </div>

        <nav class="flex-1 flex flex-col gap-1 px-3 mt-2">
            <h3 class="sr-only">{{ __('admin/layout.nav_title') }}</h3>

            <x-admin-nav-link :href="route('admin.dashboard', ['locale' => app()->getLocale()])"
                              :active="request()->routeIs('admin.dashboard')">
                <span class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center shrink-0"><x-icons.house class="w-4 h-4 text-white" fill="fill-current"/></span>
                <span>{{ __('admin/layout.dashboard') }}</span>
            </x-admin-nav-link>

            @can('manage-animals')
                <x-admin-nav-link :href="route('admin.animals.index', ['locale' => app()->getLocale()])"
                                  :active="request()->routeIs('admin.animals.*')">
                    <span class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center shrink-0"><x-icons.paw-print class="w-4 h-4 text-white" fill="fill-current"/></span>
                    <span>{{ __('admin/layout.animals') }}</span>
                </x-admin-nav-link>
            @endcan

            @can('manage-adoptions')
                <x-admin-nav-link :href="route('admin.adoptions.index', ['locale' => app()->getLocale()])"
                                  :active="request()->routeIs('admin.adoptions.*')">
                    <span class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center shrink-0"><x-icons.hand-heart class="w-4 h-4 text-white" fill="fill-current"/></span>
                    <span>{{ __('admin/layout.adoptions') }} @if ($pendingAdoptions = \App\Models\Adoption::whereIn('status', [\App\Enums\AdoptionStatus::SUBMITTED, \App\Enums\AdoptionStatus::QUEUE])->count())({{ $pendingAdoptions }})@endif</span>
                </x-admin-nav-link>
            @endcan

            @can('manage-data')
                <x-admin-nav-link :href="route('admin.data.index', ['locale' => app()->getLocale()])"
                                  :active="request()->routeIs('admin.data.*')">
                    <span class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center shrink-0"><x-icons.database class="w-4 h-4 text-white" fill="fill-current"/></span>
                    <span>{{ __('admin/layout.data') }}</span>
                </x-admin-nav-link>
            @endcan

            @if (auth()->user()->isAdmin())
                <p class="px-3 mt-4 mb-1 font-sans text-xs uppercase tracking-wide text-white/40">
                    {{ __('admin/layout.admin_section') }}
                </p>
            @endif

            @can('manage-messages')
                <x-admin-nav-link :href="route('admin.messages.index', ['locale' => app()->getLocale()])"
                                  :active="request()->routeIs('admin.messages.*')">
                    <span class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center shrink-0"><x-icons.mail class="w-4 h-4 text-white" fill="fill-current"/></span>
                    <span>{{ __('admin/layout.messages') }} @if ($unreadMessages = \App\Models\Message::whereNull('read_at')->count())({{ $unreadMessages }})@endif</span>
                </x-admin-nav-link>
            @endcan

            @can('manage-volunteers')
                <x-admin-nav-link :href="route('admin.volunteers.index', ['locale' => app()->getLocale()])"
                                  :active="request()->routeIs('admin.volunteers.*')">
                    <span class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center shrink-0"><x-icons.users class="w-4 h-4 text-white" fill="fill-current"/></span>
                    <span>{{ __('admin/layout.volunteers') }}</span>
                </x-admin-nav-link>

                <x-admin-nav-link :href="route('admin.volunteer-applications.index', ['locale' => app()->getLocale()])"
                                  :active="request()->routeIs('admin.volunteer-applications.*')">
                    <span class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center shrink-0"><x-icons.note class="w-4 h-4 text-white" fill="fill-current"/></span>
                    <span>{{ __('admin/layout.volunteer_applications') }} @if ($unreadApplications = \App\Models\VolunteerApplication::whereNull('read_at')->count())({{ $unreadApplications }})@endif</span>
                </x-admin-nav-link>
            @endcan

        </nav>

        <div class="px-3 py-4 border-t border-white/15 flex flex-col gap-1">
            <x-admin-nav-link :href="route('admin.profile', ['locale' => app()->getLocale()])"
                              :active="request()->routeIs('admin.profile')">
                <span
                    class="w-8 h-8 rounded-full bg-white/15 flex items-center justify-center overflow-hidden shrink-0">
                    @if (auth()->user()->avatar)
                        <img src="{{ Storage::url(auth()->user()->avatar) }}" alt=""
                             class="w-full h-full object-cover">
                    @else
                        <span
                            class="font-serif font-bold text-xs text-white">{{ auth()->user()->initials() }}</span>
                    @endif
                </span>
                <span>{{ auth()->user()->name }}</span>
            </x-admin-nav-link>

            <form method="POST" action="{{ route('logout', ['locale' => app()->getLocale()]) }}">
                @csrf
                <button type="submit"
                        class="w-full text-left flex items-center gap-3 px-3 py-2 rounded-lg font-serif text-white/80 hover:bg-white/10 hover:text-white cursor-pointer whitespace-nowrap">
                    <span class="w-8 h-8 rounded-lg bg-white/15 flex items-center justify-center shrink-0"><x-icons.sign-out class="w-4 h-4 text-white" fill="fill-current"/></span>
                    <span>{{ __('admin/layout.logout') }}</span>
                </button>
            </form>
        </div>
    </aside>

    <main id="main-content" class="flex-1 p-8 min-w-0">
        {{ $slot }}
    </main>
</div>

<livewire:widgets::modal/>

</body>

</html>
