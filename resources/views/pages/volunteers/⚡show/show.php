<?php

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Fiche bénévole')] class extends Component
{
    public User $volunteer;

    public function mount(User $volunteer): void
    {
        $this->authorize('view', $volunteer);

        $this->volunteer = $volunteer;

        if ($volunteer->id === auth()->id()) {
            $this->redirectRoute('admin.profile', ['locale' => app()->getLocale()]);
        }
    }

    public function delete(): void
    {
        $this->authorize('delete', $this->volunteer);

        $this->volunteer->delete();

        $this->redirectRoute('admin.volunteers.index', ['locale' => app()->getLocale()]);
    }
};
