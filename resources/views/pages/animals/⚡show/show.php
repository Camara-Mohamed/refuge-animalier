<?php

use App\Enums\AnimalStatus;
use App\Enums\UserRole;
use App\Mail\AnimalStatusUpdatedMail;
use App\Mail\DeleteNotificationMail;
use App\Models\Animal;
use App\Models\AnimalPicture;
use App\Models\Note;
use App\Models\User;
use App\Traits\HandlesAnimalAvatar;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Fiche animal')] class extends Component
{
    use HandlesAnimalAvatar, WithFileUploads;

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

        $recipients = User::where('id', '!=', auth()->id())
            ->where('receive_emails', true)
            ->where(function ($query) {
                $query->where('role', UserRole::ADMIN)
                    ->orWhere('id', $this->animal->user_id);
            })
            ->get();

        if ($recipients->isNotEmpty()) {
            Mail::to($recipients)->send(new AnimalStatusUpdatedMail($this->animal));
        }
    }

    public function addPicture(): void
    {
        $this->authorize('update', $this->animal);
        $this->validate(['newPicture' => 'nullable|image|max:4096']);

        if ($this->newPicture) {
            $this->animal->pictures()->create([
                'path' => $this->newPicture->store('animals', config('filesystems.default')),
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

        session()->flash('success', __('modals.animal-note.deleted'));
    }

    #[On('animal-note_delete_confirmed')]
    public function onAnimalNoteDeleteConfirmed(int $id): void
    {
        $this->deleteNote(Note::findOrFail($id));
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->animal);

        $name = $this->animal->name;
        $this->deleteAnimalAvatar($this->animal);
        $this->animal->delete();

        $admins = User::where('role', UserRole::ADMIN)
            ->where('id', '!=', auth()->id())
            ->where('receive_emails', true)
            ->get();

        if ($admins->isNotEmpty()) {
            Mail::to($admins)->send(new DeleteNotificationMail('Animal', $name, auth()->user()->fullName()));
        }

        session()->flash('success', __('modals.animal.deleted'));

        $this->redirectRoute('admin.animals.index', ['locale' => app()->getLocale()]);
    }

    #[On('animal_delete_confirmed')]
    public function onAnimalDeleteConfirmed(): void
    {
        $this->delete();
    }

    public function with(): array
    {
        return [
            'pictures' => $this->animal->pictures,
            'notes' => $this->animal->notes()->with('user')->latest()->get(),
        ];
    }
};
