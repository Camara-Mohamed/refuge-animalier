<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.messages'), 'url' => route('admin.messages.index', ['locale' => app()->getLocale()])],
        ['label' => $message->subject ?? $message->name, 'url' => '#'],
    ]" :key="'message-show-breadcrumb'" />

    <div class="flex items-center justify-between gap-4 flex-wrap">
        <h1 class="font-serif font-bold text-2xl text-blue-strong">{{ $message->subject ?? 'Sans sujet' }}</h1>

        <div class="flex items-center gap-4">
            <a href="mailto:{{ $message->email }}" class="font-sans text-sm font-semibold text-blue-strong hover:text-red-strong">
                Répondre
            </a>

            @can('delete', $message)
                <button wire:click="delete" wire:confirm="Supprimer ce message ?"
                        class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                    Supprimer
                </button>
            @endcan
        </div>
    </div>

    <ul class="flex flex-col gap-1 font-sans text-sm text-blue-strong">
        <li>De : {{ $message->name }} ({{ $message->email }})</li>
        <li>Reçu le : {{ $message->created_at->format('d/m/Y H:i') }}</li>
    </ul>

    <p class="font-sans text-blue-strong whitespace-pre-line">{{ $message->message }}</p>
</div>
