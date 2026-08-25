<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.messages'), 'url' => route('admin.messages.index', ['locale' => app()->getLocale()])],
    ]" :key="'messages-index-breadcrumb'" />

    <x-flash />

    <h2 class="font-serif font-bold text-2xl text-blue-strong">{{ __('admin/messages.index_title') }}</h2>

    <div class="flex items-center gap-4 flex-wrap">
        <x-forms.input for="search" type="text" placeholder="{{ __('admin/messages.search_placeholder') }}"
                        wire:model.live.debounce.300ms="search" class="w-64">
            <span class="sr-only">{{ __('admin/common.search') }}</span>
        </x-forms.input>

        <x-filter-panel>
            <x-forms.select for="statusFilter" wire:model.live="statusFilter" label_title="{{ __('admin/messages.filter_status') }}">
                <option value="">{{ __('admin/messages.all_statuses') }}</option>
                <option value="unread">{{ __('admin/messages.unread') }}</option>
                <option value="read">{{ __('admin/messages.read') }}</option>
            </x-forms.select>
        </x-filter-panel>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($messages as $message)
            <div wire:key="message-{{ $message->id }}"
                 class="p-4 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20 flex flex-col gap-2">
                <div class="flex items-start justify-between gap-2">
                    <span class="font-sans {{ $message->isRead() ? 'text-blue-strong/70' : 'font-bold text-blue-strong' }}">
                        {{ $message->name }}
                    </span>
                    <x-badge :color="$message->isRead() ? 'bg-gray-100 text-gray-600' : 'bg-red-strong/10 text-red-strong'">
                        {{ $message->isRead() ? __('admin/messages.read') : __('admin/messages.unread') }}
                    </x-badge>
                </div>

                <span class="font-sans text-sm {{ $message->isRead() ? 'text-blue-strong/70' : 'font-bold text-blue-strong' }}">
                    {{ $message->subject ?? '-' }}
                </span>

                <span class="font-sans text-xs text-blue-strong/50">{{ $message->created_at->format('d/m/Y H:i') }}</span>

                <div class="flex items-center gap-4 mt-2 pt-2 border-t border-red-strong/10">
                    <x-admin-link :href="route('admin.messages.show', ['locale' => app()->getLocale(), 'message' => $message])"
                       class="font-sans text-sm font-semibold text-red-strong hover:text-red-normal">
                        {{ __('admin/common.view') }}
                    </x-admin-link>
                    <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $message->id }}', model_type: 'message' } })"
                            class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                        {{ __('admin/common.delete') }}
                    </button>
                </div>
            </div>
        @empty
            <p class="font-sans text-blue-strong/70">{{ __('admin/messages.no_messages') }}</p>
        @endforelse
    </div>

    <div>
        {{ $messages->links() }}
    </div>
</div>
