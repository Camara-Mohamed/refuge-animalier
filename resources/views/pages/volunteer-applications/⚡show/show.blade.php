<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.volunteer_applications'), 'url' => route('admin.volunteer-applications.index', ['locale' => app()->getLocale()])],
        ['label' => $application->name, 'url' => '#'],
    ]" :key="'volunteer-application-show-breadcrumb'" />

    <x-flash />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <h2 class="font-serif font-bold text-2xl text-blue-strong">{{ $application->name }}</h2>

        <div class="flex items-center gap-4">
            @can('create', \App\Models\User::class)
                <x-admin-link :href="route('admin.volunteers.create', ['locale' => app()->getLocale()])"
                   class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                    {{ __('admin/common.create_account') }}
                </x-admin-link>
            @endcan

            <a href="mailto:{{ $application->email }}" class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                {{ __('admin/common.reply') }}
            </a>

            @can('delete', $application)
                <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $application->id }}', model_type: 'volunteer-application' } })"
                        class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                    {{ __('admin/common.delete') }}
                </button>
            @endcan
        </div>
    </div>

    <div class="p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20 flex flex-col gap-4 max-w-2xl">
        <x-data-row label="{{ __('admin/volunteer_applications.email') }}">{{ $application->email }}</x-data-row>
        <x-data-row label="{{ __('admin/volunteer_applications.phone') }}">{{ $application->phone }}</x-data-row>
        <x-data-row label="{{ __('admin/volunteer_applications.address') }}">{{ $application->address }} {{ $application->number }}, {{ $application->code_postal }} {{ $application->city }}</x-data-row>

        <x-data-row label="{{ __('admin/volunteer_applications.availabilities') }}">
            {{ collect($application->availabilities ?? [])->map(fn ($day) => \App\Enums\Day::from($day)->label())->implode(', ') ?: '-' }}
        </x-data-row>
        <x-data-row label="{{ __('admin/volunteer_applications.received_on') }}">{{ $application->created_at->format('d/m/Y H:i') }}</x-data-row>
    </div>
</div>
