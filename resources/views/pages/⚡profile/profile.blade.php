<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.profile'), 'url' => route('admin.profile', ['locale' => app()->getLocale()])],
    ]" :key="'profile-breadcrumb'" />

    <h2 class="font-serif font-bold text-2xl text-blue-strong">Mon profil</h2>

    <div class="flex flex-col gap-6 max-w-2xl">
        <form wire:submit="saveAvatar" class="flex flex-col gap-4 p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
            <x-flash key="success_avatar" />

            <x-forms.fieldset title="Photo de profil">
                <div class="flex items-center gap-4">
                    <span class="w-16 h-16 rounded-full bg-red-light flex items-center justify-center overflow-hidden shrink-0">
                        @if ($avatarFile)
                            <img src="{{ $avatarFile->temporaryUrl() }}" alt="" class="w-full h-full object-cover">
                        @elseif (auth()->user()->avatar)
                            <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="" class="w-full h-full object-cover">
                        @else
                            <span class="font-serif font-bold text-blue-strong">{{ auth()->user()->initials() }}</span>
                        @endif
                    </span>

                    <div class="flex flex-col gap-2">
                        <input type="file" id="avatarFile" wire:model="avatarFile"
                               class="font-serif text-sm text-blue-strong file:bg-transparent file:border-0 file:p-0 file:mr-2 file:font-serif file:text-sm file:font-medium file:text-red-strong file:underline file:cursor-pointer hover:file:text-red-normal file:transition-colors">
                        @error('avatarFile') <p class="font-serif text-sm text-red-normal">{{ $message }}</p> @enderror

                        @if ($avatarFile)
                            <button type="button" wire:click="removeNewAvatar" class="font-sans text-sm text-red-normal hover:text-red-strong w-fit cursor-pointer">
                                Annuler la nouvelle photo
                            </button>
                        @endif
                    </div>
                </div>
            </x-forms.fieldset>

            <x-forms.button type="submit" class="bg-red-strong border-red-strong text-white
                hover:bg-white hover:text-red-strong hover:border-red-strong w-fit text-sm px-4 py-2">
                Enregistrer la photo
            </x-forms.button>
        </form>

        <form wire:submit="saveInfo" class="flex flex-col gap-4 p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
            <x-flash key="success_info" />

            <x-forms.fieldset title="Nom">
                <x-forms.input for="name" wire:model="name" type="text" :required="true">
                    Nom
                </x-forms.input>
            </x-forms.fieldset>

            <x-forms.fieldset title="Adresse">
                <div class="grid grid-cols-2 gap-4">
                    <x-forms.input for="address" wire:model="address" type="text">
                        Rue
                    </x-forms.input>

                    <x-forms.input for="number" wire:model="number" type="text">
                        Numéro
                    </x-forms.input>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <x-forms.input for="city" wire:model="city" type="text">
                        Ville
                    </x-forms.input>

                    <x-forms.input for="code_postal" wire:model="code_postal" type="text">
                        Code postal
                    </x-forms.input>
                </div>
            </x-forms.fieldset>

            <x-forms.button type="submit" class="bg-red-strong border-red-strong text-white
                hover:bg-white hover:text-red-strong hover:border-red-strong w-fit text-sm px-4 py-2">
                Enregistrer les informations
            </x-forms.button>
        </form>

        <form wire:submit="saveNotifications" class="flex flex-col gap-4 p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
            <x-flash key="success_notifications" />

            <x-forms.fieldset title="Notifications">
                <label class="flex items-center gap-2 font-serif text-sm text-blue-strong">
                    <input type="checkbox" id="receive_emails" wire:model="receive_emails">
                    Recevoir des emails de notification
                </label>
            </x-forms.fieldset>

            <x-forms.button type="submit" class="bg-red-strong border-red-strong text-white
                hover:bg-white hover:text-red-strong hover:border-red-strong w-fit text-sm px-4 py-2">
                Enregistrer
            </x-forms.button>
        </form>

        <form wire:submit="saveEmail" class="flex flex-col gap-4 p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
            <x-flash key="success_email" />

            <x-forms.fieldset title="Email">
                <x-forms.input for="email" wire:model="email" type="email" :required="true">
                    Email
                </x-forms.input>
            </x-forms.fieldset>

            <x-forms.button type="submit" class="bg-red-strong border-red-strong text-white
                hover:bg-white hover:text-red-strong hover:border-red-strong w-fit text-sm px-4 py-2">
                Enregistrer l'email
            </x-forms.button>
        </form>

        <form wire:submit="savePassword" class="flex flex-col gap-4 p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
            <x-flash key="success_password" />

            <x-forms.fieldset title="Mot de passe">
                <x-forms.input for="password" wire:model="password" type="password" placeholder="••••••••">
                    Nouveau mot de passe
                </x-forms.input>
            </x-forms.fieldset>

            <x-forms.button type="submit" class="bg-red-strong border-red-strong text-white
                hover:bg-white hover:text-red-strong hover:border-red-strong w-fit text-sm px-4 py-2">
                Enregistrer le mot de passe
            </x-forms.button>
        </form>

        <form wire:submit="saveAvailabilities" class="flex flex-col gap-4 p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
            <x-flash key="success_availabilities" />

            <x-forms.fieldset title="Disponibilités">
                <div class="flex flex-wrap gap-2">
                    @foreach (\App\Enums\Day::cases() as $day)
                        <label for="availability-{{ $day->value }}"
                               class="px-4 py-2 rounded-lg border border-gray-300 text-blue-strong font-serif text-sm cursor-pointer transition-colors has-checked:bg-red-strong has-checked:text-white has-checked:border-red-strong">
                            <input type="checkbox" id="availability-{{ $day->value }}" wire:model="availabilities" value="{{ $day->value }}" class="sr-only">
                            {{ $day->label() }}
                        </label>
                    @endforeach
                </div>
            </x-forms.fieldset>

            <x-forms.button type="submit" class="bg-red-strong border-red-strong text-white
                hover:bg-white hover:text-red-strong hover:border-red-strong w-fit text-sm px-4 py-2">
                Enregistrer les disponibilités
            </x-forms.button>
        </form>
    </div>
</div>
