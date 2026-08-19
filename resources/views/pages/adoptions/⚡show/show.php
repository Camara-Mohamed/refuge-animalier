<?php

use App\Enums\AdoptionStatus;
use App\Models\Adoption;
use App\Models\Note;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

new #[Title('Détail adoption')] class extends Component
{
    public Adoption $adoption;

    #[Validate('required|string|max:2000')]
    public string $newNote = '';

    public function mount(Adoption $adoption): void
    {
        $this->authorize('view', $adoption);
        $this->adoption = $adoption;
    }

    public function changeStatus(string $status): void
    {
        $this->authorize('changeStatus', $this->adoption);

        $this->adoption->update(['status' => AdoptionStatus::from($status)]);
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->adoption);

        $this->adoption->delete();

        $this->redirectRoute('admin.adoptions.index', ['locale' => app()->getLocale()]);
    }

    public function addNote(): void
    {
        $this->authorize('create', Note::class);
        $this->validate(['newNote' => 'required|string|max:2000']);

        $this->adoption->notes()->create([
            'content' => $this->newNote,
            'user_id' => auth()->id(),
        ]);

        $this->reset('newNote');
    }

    public function deleteNote(Note $note): void
    {
        $this->authorize('delete', $note);

        $note->delete();
    }

    public function with(): array
    {
        return [
            'notes' => $this->adoption->notes()->with('user')->latest()->get(),
        ];
    }
};
