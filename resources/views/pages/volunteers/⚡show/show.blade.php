<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.volunteers'), 'url' => route('admin.volunteers.index', ['locale' => app()->getLocale()])],
        ['label' => $volunteer->name, 'url' => '#'],
    ]" :key="'volunteer-show-breadcrumb'" />

    <x-flash />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <div class="flex items-center gap-2">
            <h2 class="font-serif font-bold text-2xl text-blue-strong">{{ $volunteer->name }}</h2>
            <x-badge :color="$volunteer->role->color()">{{ $volunteer->role->label() }}</x-badge>
        </div>

        <div class="flex items-center gap-4">
            @can('update', $volunteer)
                <x-admin-link :href="route('admin.volunteers.edit', ['locale' => app()->getLocale(), 'volunteer' => $volunteer])"
                   class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                    {{ __('admin/common.edit') }}
                </x-admin-link>
            @endcan

            @can('delete', $volunteer)
                <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $volunteer->id }}', model_type: 'volunteer' } })"
                        class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                    {{ __('admin/common.delete') }}
                </button>
            @endcan
        </div>
    </div>

    <div class="p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20 flex flex-col gap-4 max-w-2xl">
        @if ($volunteer->avatar)
            <img src="{{ Storage::url($volunteer->avatar) }}" alt="{{ $volunteer->name }}" width="80" class="rounded-full" loading="lazy">
        @endif

        <x-data-row label="{{ __('admin/volunteers.email') }}">{{ $volunteer->email }}</x-data-row>
        <x-data-row label="{{ __('admin/volunteers.phone') }}">{{ $volunteer->phone ?? '-' }}</x-data-row>
        <x-data-row label="{{ __('admin/volunteers.address') }}">{{ $volunteer->address ?? '-' }} {{ $volunteer->number ?? '' }}, {{ $volunteer->code_postal ?? '' }} {{ $volunteer->city ?? '' }}</x-data-row>

        <hr class="border-red-strong/20">

        <x-data-row label="{{ __('admin/volunteers.availabilities') }}">
            {{ collect($volunteer->availabilities ?? [])->map(fn ($day) => \App\Enums\Day::from($day)->label())->implode(', ') ?: '-' }}
        </x-data-row>
    </div>
</div>
