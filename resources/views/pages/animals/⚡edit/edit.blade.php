<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.animals'), 'url' => route('admin.animals.index', ['locale' => app()->getLocale()])],
        ['label' => $animal->name, 'url' => route('admin.animals.show', ['locale' => app()->getLocale(), 'animal' => $animal])],
        ['label' => __('breadcrumbs.edit'), 'url' => '#'],
    ]" :key="'animals-edit-breadcrumb'" />

    <h2 class="font-serif font-bold text-2xl text-blue-strong">Modifier {{ $animal->name }}</h2>

    <form wire:submit="save" class="flex flex-col gap-6 max-w-2xl p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
        <x-forms.fieldset title="Informations générales">
            <x-forms.input for="name" wire:model="name" type="text" :required="true">
                Nom
            </x-forms.input>

            <x-forms.textarea for="description" wire:model="description">
                Description
            </x-forms.textarea>
        </x-forms.fieldset>

        <x-forms.fieldset title="Catégorisation">
            <div class="flex flex-col gap-2">
                <label for="specie_id" class="font-medium font-serif text-blue-strong">Espèce</label>
                <x-forms.select for="specie_id" wire:model="specie_id" class="w-full">
                    <option value="">-- aucune --</option>
                    @foreach ($species as $specie)
                        <option value="{{ $specie->id }}">{{ $specie->name }}</option>
                    @endforeach
                </x-forms.select>
            </div>

            <div class="flex flex-col gap-2">
                <label for="race_id" class="font-medium font-serif text-blue-strong">Race</label>
                <x-forms.select for="race_id" wire:model="race_id" class="w-full">
                    <option value="">-- aucune --</option>
                    @foreach ($races as $race)
                        <option value="{{ $race->id }}">{{ $race->name }}</option>
                    @endforeach
                </x-forms.select>
            </div>

            <div class="flex flex-col gap-2">
                <label for="coat_id" class="font-medium font-serif text-blue-strong">Pelage</label>
                <x-forms.select for="coat_id" wire:model="coat_id" class="w-full">
                    <option value="">-- aucun --</option>
                    @foreach ($coats as $coat)
                        <option value="{{ $coat->id }}">{{ $coat->name }}</option>
                    @endforeach
                </x-forms.select>
            </div>
        </x-forms.fieldset>

        <x-forms.fieldset title="Photo">
            <div class="flex flex-col gap-2">
                <label for="avatarFile" class="font-medium font-serif text-blue-strong">Remplacer la photo principale</label>
                @if ($animal->avatar && ! $avatarFile)
                    <img src="{{ $animal->avatarUrl(320) }}" width="150" class="rounded-lg">
                @endif
                <input type="file" id="avatarFile" wire:model="avatarFile"
                       class="font-serif text-sm text-blue-strong file:bg-transparent file:border-0 file:p-0 file:mr-2 file:font-serif file:text-sm file:font-medium file:text-red-strong file:underline file:cursor-pointer hover:file:text-red-normal file:transition-colors">
                @error('avatarFile') <p class="font-serif text-sm text-red-normal">{{ $message }}</p> @enderror
                @if ($avatarFile)
                    <img src="{{ $avatarFile->temporaryUrl() }}" width="150" class="rounded-lg">
                @endif
            </div>
        </x-forms.fieldset>

        <x-forms.button type="submit" class="bg-red-strong border-red-strong text-white
            hover:bg-white hover:text-red-strong hover:border-red-strong w-fit">
            Enregistrer
        </x-forms.button>
    </form>
</div>
