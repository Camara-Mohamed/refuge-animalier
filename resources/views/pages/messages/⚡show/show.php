<?php

use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Message')] class extends Component
{
    public Message $message;

    public function mount(Message $message): void
    {
        $this->authorize('view', $message);

        $message->markAsRead();

        $this->message = $message;
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->message);

        $this->message->delete();

        session()->flash('success', __('modals.message.deleted'));

        $this->redirectRoute('admin.messages.index', ['locale' => app()->getLocale()]);
    }

    #[On('message_delete_confirmed')]
    public function onMessageDeleteConfirmed(): void
    {
        $this->delete();
    }
};
