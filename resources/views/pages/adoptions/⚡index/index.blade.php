<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.adoptions'), 'url' => route('admin.adoptions.index', ['locale' => app()->getLocale()])],
    ]" :key="'adoptions-index-breadcrumb'" />

    <x-flash />

    <div class="flex items-center justify-between flex-wrap">
        <h2 class="font-serif font-bold text-2xl text-blue-strong">{{ __('admin/adoptions.index_title') }}</h2>
    </div>

    <div class="flex items-start gap-4 flex-wrap">
        <x-forms.input for="search" type="text" placeholder="{{ __('admin/adoptions.search_placeholder') }}"
                        wire:model.live.debounce.300ms="search" class="w-64">
            <span class="sr-only">{{ __('admin/common.search') }}</span>
        </x-forms.input>

        <x-filter-panel>
            <x-forms.select for="statusFilter" wire:model.live="statusFilter" label_title="{{ __('admin/adoptions.filter_status') }}">
                <option value="">{{ __('admin/adoptions.all_statuses') }}</option>
                @foreach (\App\Enums\AdoptionStatus::cases() as $status)
                    <option value="{{ $status->value }}">{{ $status->label() }}</option>
                @endforeach
            </x-forms.select>
        </x-filter-panel>

        @can('create', \App\Models\Adoption::class)
            <x-admin-link :href="route('admin.adoptions.create', ['locale' => app()->getLocale()])"
                          class="px-4 h-[50px] flex items-center justify-center rounded-lg bg-red-strong text-white font-sans text-sm font-semibold
                          hover:bg-red-normal">
                {{ __('admin/adoptions.new_adoption') }}
            </x-admin-link>
        @endcan
    </div>

    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-200">
                <th class="text-left font-sans text-sm text-blue-strong/70 py-2">{{ __('admin/adoptions.adopter') }}</th>
                <th class="text-left font-sans text-sm text-blue-strong/70 py-2">{{ __('admin/adoptions.animal') }}</th>
                <th class="text-left font-sans text-sm text-blue-strong/70 py-2">{{ __('admin/adoptions.requested_on') }}</th>
                <th class="text-left font-sans text-sm text-blue-strong/70 py-2">{{ __('admin/adoptions.status') }}</th>
                <th class="py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($adoptions as $adoption)
                <tr wire:key="adoption-{{ $adoption->id }}">
                    <td class="py-2 font-sans text-blue-strong">{{ $adoption->adopter->name }}</td>
                    <td class="py-2 font-sans text-blue-strong/70">{{ $adoption->animal->name }}</td>
                    <td class="py-2 font-sans text-blue-strong/70">{{ $adoption->created_at->format('d/m/Y') }}</td>
                    <td class="py-2">
                        @can('changeStatus', $adoption)
                            <select wire:change="changeStatus({{ $adoption->id }}, $event.target.value)"
                                    class="px-2 py-1 rounded-lg border border-gray-200 font-sans text-sm text-blue-strong focus:outline-none focus:border-red-strong">
                                @foreach (\App\Enums\AdoptionStatus::cases() as $status)
                                    <option value="{{ $status->value }}" @selected($status === $adoption->status)>{{ $status->label() }}</option>
                                @endforeach
                            </select>
                        @else
                            <x-badge :color="$adoption->status->color()">{{ $adoption->status->label() }}</x-badge>
                        @endcan
                    </td>
                    <td class="py-2 text-right flex items-center justify-end gap-4">
                        <x-admin-link :href="route('admin.adoptions.show', ['locale' => app()->getLocale(), 'adoption' => $adoption])"
                           class="font-sans text-sm font-semibold text-red-strong hover:text-red-normal">
                            {{ __('admin/common.view') }}
                        </x-admin-link>
                        @can('delete', $adoption)
                            <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $adoption->id }}', model_type: 'adoption' } })"
                                    class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                                {{ __('admin/common.delete') }}
                            </button>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-6 text-center font-sans text-blue-strong/70">
                        {{ __('admin/adoptions.no_requests') }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6">
        {{ $adoptions->links() }}
    </div>
</div>
