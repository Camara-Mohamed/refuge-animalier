<?php

use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Messages')] class extends Component
{
    use WithPagination;

    public string $search = '';

    public string $statusFilter = '';

    public function mount(): void
    {
        $this->authorize('viewAny', Message::class);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
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
        $messages = Message::query()
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('subject', 'like', "%{$this->search}%");
            }))
            ->when($this->statusFilter === 'read', fn ($q) => $q->whereNotNull('read_at'))
            ->when($this->statusFilter === 'unread', fn ($q) => $q->whereNull('read_at'))
            ->latest()
            ->paginate(10);

        return [
            'messages' => $messages,
        ];
    }
};
