<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.adoptions'), 'url' => route('admin.adoptions.index', ['locale' => app()->getLocale()])],
        ['label' => __('admin/adoptions.new_adoption'), 'url' => '#'],
    ]" :key="'adoptions-create-breadcrumb'" />

    <h2 class="font-serif font-bold text-2xl text-blue-strong">{{ __('admin/adoptions.create_title') }}</h2>

    <form wire:submit="save" class="flex flex-col gap-6 max-w-2xl">
        <div class="flex flex-col gap-4">
            <h2 class="font-serif font-semibold text-blue-strong">{{ __('admin/adoptions.animal_section') }}</h2>

            <x-forms.select for="animal_id" wire:model="animal_id" :required="true" label_title="{{ __('admin/adoptions.animal_section') }}">
                <option value="">{{ __('admin/adoptions.select_animal') }}</option>
                @foreach ($animals as $animal)
                    <option value="{{ $animal->id }}">{{ $animal->name }} ({{ $animal->specie?->name }})</option>
                @endforeach
            </x-forms.select>
            @error('animal_id')
                <p class="font-serif text-sm text-red-normal">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col gap-4 pt-4 border-t border-blue-strong/10">
            <h2 class="font-serif font-semibold text-blue-strong">{{ __('admin/adoptions.personal_info') }}</h2>

            <x-forms.input for="name" wire:model="name" type="text" :required="true">
                {{ __('admin/adoptions.full_name') }}
            </x-forms.input>

            <x-forms.input for="email" wire:model="email" type="email" :required="true">
                {{ __('admin/adoptions.email') }}
            </x-forms.input>

            <x-forms.input for="phone" wire:model="phone" type="tel" :required="true">
                {{ __('admin/adoptions.phone') }}
            </x-forms.input>
        </div>

        <div class="flex flex-col gap-4 pt-4 border-t border-blue-strong/10">
            <h2 class="font-serif font-semibold text-blue-strong">{{ __('admin/adoptions.address_section') }}</h2>

            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2">
                    <x-forms.input for="address" wire:model="address" type="text" :required="true">
                        {{ __('admin/adoptions.street') }}
                    </x-forms.input>
                </div>
                <x-forms.input for="number" wire:model="number" type="text" :required="true">
                    {{ __('admin/adoptions.number') }}
                </x-forms.input>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <x-forms.input for="city" wire:model="city" type="text" :required="true">
                    {{ __('admin/adoptions.city') }}
                </x-forms.input>

                <x-forms.input for="postal_code" wire:model="postal_code" type="text" :required="true">
                    {{ __('admin/adoptions.postal_code') }}
                </x-forms.input>
            </div>

            <div class="grid grid-cols-2 gap-4 items-end">
                <div class="flex flex-col gap-2">
                    <label for="house_type" class="font-medium font-serif text-blue-strong">
                        {{ __('admin/adoptions.housing_type') }}
                        <small><abbr class="text-red-normal" title="{{ __('admin/adoptions.required_field') }}">*</abbr></small>
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
                    {{ __('admin/adoptions.has_garden') }}
                </label>
            </div>
        </div>

        <div class="flex flex-col gap-4 pt-4 border-t border-blue-strong/10">
            <h2 class="font-serif font-semibold text-blue-strong">{{ __('admin/adoptions.motivation_section') }}</h2>

            <x-forms.textarea for="message" wire:model="message" :required="true">
                {{ __('admin/adoptions.message') }}
            </x-forms.textarea>
        </div>

        <x-forms.button type="submit" class="bg-red-strong border-red-strong text-white
            hover:bg-white hover:text-red-strong hover:border-red-strong">
            {{ __('admin/adoptions.submit') }}
        </x-forms.button>
    </form>
</div>
