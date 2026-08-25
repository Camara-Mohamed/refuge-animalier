<?php

use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Messages')] class extends Component
{
    use WithPagination;

    public function mount(): void
    {
        $this->authorize('viewAny', Message::class);
    }

    public function delete(Message $message): void
    {
        $this->authorize('delete', $message);

        $message->delete();

        session()->flash('success', __('modals.message.deleted'));
    }

    #[On('message_delete_confirmed')]
    public function onMessageDeleteConfirmed(int $id): void
    {
        $this->delete(Message::findOrFail($id));
    }

    public function with(): array
    {
        return [
            'messages' => Message::query()->latest()->paginate(10),
        ];
    }
};
