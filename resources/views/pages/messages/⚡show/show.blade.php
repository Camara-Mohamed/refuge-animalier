<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.messages'), 'url' => route('admin.messages.index', ['locale' => app()->getLocale()])],
        ['label' => $message->subject ?? $message->name, 'url' => '#'],
    ]" :key="'message-show-breadcrumb'" />

    <x-flash />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <h2 class="font-serif font-bold text-2xl text-blue-strong">{{ $message->subject ?? 'Sans sujet' }}</h2>

        <div class="flex items-center gap-4">
            <a href="mailto:{{ $message->email }}" class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                Répondre
            </a>

            @can('delete', $message)
                <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $message->id }}', model_type: 'message' } })"
                        class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                    Supprimer
                </button>
            @endcan
        </div>
    </div>

    <div class="p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20 flex flex-col gap-4 max-w-2xl">
        <x-data-row label="De">{{ $message->name }} ({{ $message->email }})</x-data-row>
        <x-data-row label="Reçu le">{{ $message->created_at->format('d/m/Y H:i') }}</x-data-row>

        <p class="font-sans text-blue-strong whitespace-pre-line">{{ $message->message }}</p>
    </div>
</div>
