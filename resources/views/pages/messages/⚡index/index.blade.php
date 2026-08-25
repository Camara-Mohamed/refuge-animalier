<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.messages'), 'url' => route('admin.messages.index', ['locale' => app()->getLocale()])],
    ]" :key="'messages-index-breadcrumb'" />

    <x-flash />

    <h1 class="font-serif font-bold text-2xl text-blue-strong">Messages</h1>

    <table class="w-full">
        <thead>
            <tr class="border-b border-gray-200">
                <th class="text-left font-sans text-sm text-blue-strong/70 py-2">De</th>
                <th class="text-left font-sans text-sm text-blue-strong/70 py-2">Sujet</th>
                <th class="text-left font-sans text-sm text-blue-strong/70 py-2">Reçu le</th>
                <th class="text-left font-sans text-sm text-blue-strong/70 py-2">Statut</th>
                <th class="py-2"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($messages as $message)
                <tr wire:key="message-{{ $message->id }}">
                    <td class="py-2 font-sans {{ $message->isRead() ? 'text-blue-strong/70' : 'font-bold text-blue-strong' }}">
                        {{ $message->name }}
                    </td>
                    <td class="py-2 font-sans {{ $message->isRead() ? 'text-blue-strong/70' : 'font-bold text-blue-strong' }}">
                        {{ $message->subject ?? '—' }}
                    </td>
                    <td class="py-2 font-sans text-blue-strong/70">{{ $message->created_at->format('d/m/Y H:i') }}</td>
                    <td class="py-2">
                        <x-badge :color="$message->isRead() ? 'bg-gray-100 text-gray-600' : 'bg-red-strong/10 text-red-strong'">
                            {{ $message->isRead() ? 'Lu' : 'Non lu' }}
                        </x-badge>
                    </td>
                    <td class="py-2 text-right flex items-center justify-end gap-4">
                        <x-admin-link :href="route('admin.messages.show', ['locale' => app()->getLocale(), 'message' => $message])"
                           class="font-sans text-sm font-semibold text-red-strong hover:text-red-normal">
                            Voir
                        </x-admin-link>
                        <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $message->id }}', model_type: 'message' } })"
                                class="font-sans text-sm font-semibold text-red-normal hover:text-red-strong cursor-pointer">
                            Supprimer
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="py-6 text-center font-sans text-blue-strong/70">
                        Aucun message pour le moment.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        {{ $messages->links() }}
    </div>
</div>
