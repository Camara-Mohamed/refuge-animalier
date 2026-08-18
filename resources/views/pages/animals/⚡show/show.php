<?php

use App\Enums\AnimalStatus;
use App\Models\Animal;
use App\Models\AnimalPicture;
use App\Models\Note;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Fiche animal')] class extends Component
{
    use WithFileUploads;

    public Animal $animal;

    #[Validate('nullable|image|max:4096')]
    public $newPicture = null;

    #[Validate('required|string|max:2000')]
    public string $newNote = '';

    public function mount(Animal $animal): void
    {
        $this->authorize('view', $animal);
        $this->animal = $animal;
    }

    public function changeStatus(string $status): void
    {
        $this->authorize('update', $this->animal);

        $this->animal->update(['status' => AnimalStatus::from($status)]);
    }

    public function addPicture(): void
    {
        $this->authorize('update', $this->animal);
        $this->validate(['newPicture' => 'nullable|image|max:4096']);

        if ($this->newPicture) {
            $this->animal->pictures()->create([
                'path' => $this->newPicture->store('animals', 'public'),
                'alt' => $this->animal->name,
            ]);
        }

        $this->reset('newPicture');
    }

    public function deletePicture(AnimalPicture $picture): void
    {
        $this->authorize('update', $this->animal);

        $picture->delete();
    }

    public function addNote(): void
    {
        $this->authorize('create', Note::class);
        $this->validate(['newNote' => 'required|string|max:2000']);

        $this->animal->notes()->create([
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

    public function delete(): void
    {
        $this->authorize('delete', $this->animal);

        $this->animal->delete();

        $this->redirectRoute('admin.animals.index', ['locale' => app()->getLocale()]);
    }

    public function with(): array
    {
        return [
            'pictures' => $this->animal->pictures,
            'notes' => $this->animal->notes()->with('user')->latest()->get(),
        ];
    }
};
