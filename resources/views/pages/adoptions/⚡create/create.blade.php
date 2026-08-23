<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.adoptions'), 'url' => route('admin.adoptions.index', ['locale' => app()->getLocale()])],
        ['label' => 'Nouvelle adoption', 'url' => '#'],
    ]" :key="'adoptions-create-breadcrumb'" />

    <h1 class="font-serif font-bold text-2xl text-blue-strong">Nouvelle adoption</h1>

    <form wire:submit="save" class="flex flex-col gap-6 max-w-2xl">
        <div class="flex flex-col gap-4">
            <h2 class="font-serif font-semibold text-blue-strong">Animal</h2>

            <x-forms.select for="animal_id" wire:model="animal_id" :required="true" label_title="Animal">
                <option value="">Sélectionner un animal</option>
                @foreach ($animals as $animal)
                    <option value="{{ $animal->id }}">{{ $animal->name }} ({{ $animal->specie?->name }})</option>
                @endforeach
            </x-forms.select>
            @error('animal_id')
                <p class="font-serif text-sm text-red-normal">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col gap-4 pt-4 border-t border-blue-strong/10">
            <h2 class="font-serif font-semibold text-blue-strong">Informations personnelles</h2>

            <x-forms.input for="name" wire:model="name" type="text" :required="true">
                Nom (complet)
            </x-forms.input>

            <x-forms.input for="email" wire:model="email" type="email" :required="true">
                Email
            </x-forms.input>

            <x-forms.input for="phone" wire:model="phone" type="tel" :required="true">
                Téléphone
            </x-forms.input>
        </div>

        <div class="flex flex-col gap-4 pt-4 border-t border-blue-strong/10">
            <h2 class="font-serif font-semibold text-blue-strong">Adresse</h2>

            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2">
                    <x-forms.input for="address" wire:model="address" type="text" :required="true">
                        Rue
                    </x-forms.input>
                </div>
                <x-forms.input for="number" wire:model="number" type="text" :required="true">
                    Numéro
                </x-forms.input>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <x-forms.input for="city" wire:model="city" type="text" :required="true">
                    Ville
                </x-forms.input>

                <x-forms.input for="postal_code" wire:model="postal_code" type="text" :required="true">
                    Code postal
                </x-forms.input>
            </div>

            <div class="grid grid-cols-2 gap-4 items-end">
                <div class="flex flex-col gap-2">
                    <label for="house_type" class="font-medium font-serif text-blue-strong">
                        Type de logement
                        <small><abbr class="text-red-normal" title="Champ requis">*</abbr></small>
                    </label>
                    <x-forms.select for="house_type" wire:model="house_type" :required="true" class="h-12 w-full">
                        @foreach(\App\Enums\House::cases() as $houseType)
                            <option value="{{ $houseType->value }}">{{ $houseType->label() }}</option>
                        @endforeach
                    </x-forms.select>
                </div>

                <label for="have_garden"
                       class="h-12 flex items-center justify-center gap-2 px-4 rounded-lg border border-gray-300 text-blue-strong font-medium cursor-pointer transition-colors has-checked:bg-red-strong has-checked:text-white has-checked:border-red-strong">
                    <input type="checkbox" id="have_garden" wire:model="have_garden" class="sr-only">
                    A un jardin
                </label>
            </div>
        </div>

        <div class="flex flex-col gap-4 pt-4 border-t border-blue-strong/10">
            <h2 class="font-serif font-semibold text-blue-strong">Motivation</h2>

            <x-forms.textarea for="message" wire:model="message" :required="true">
                Message
            </x-forms.textarea>
        </div>

        <x-forms.button type="submit" class="bg-red-strong border-red-strong text-white
            hover:bg-white hover:text-red-strong hover:border-red-strong">
            Créer la demande d'adoption
        </x-forms.button>
    </form>
</div>
