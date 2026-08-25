<?php

use App\Enums\AdoptionStatus;
use App\Mail\AdoptionStatusUpdatedMail;
use App\Models\Adoption;
use App\Models\Note;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\On;
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

        if (in_array($this->adoption->status, [AdoptionStatus::ACCEPTED, AdoptionStatus::REJECTED])) {
            Mail::to($this->adoption->adopter->email)->send(new AdoptionStatusUpdatedMail($this->adoption));
        }
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->adoption);

        $this->adoption->delete();

        session()->flash('success', __('modals.adoption.deleted'));

        $this->redirectRoute('admin.adoptions.index', ['locale' => app()->getLocale()]);
    }

    #[On('adoption_delete_confirmed')]
    public function onAdoptionDeleteConfirmed(): void
    {
        $this->delete();
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

        session()->flash('success', __('modals.adoption-note.deleted'));
    }

    #[On('adoption-note_delete_confirmed')]
    public function onAdoptionNoteDeleteConfirmed(int $id): void
    {
        $this->deleteNote(Note::findOrFail($id));
    }

    public function with(): array
    {
        return [
            'notes' => $this->adoption->notes()->with('user')->latest()->get(),
        ];
    }
};
