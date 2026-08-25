<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.volunteers'), 'url' => route('admin.volunteers.index', ['locale' => app()->getLocale()])],
        ['label' => __('admin/volunteers.create_profile'), 'url' => '#'],
    ]" :key="'volunteer-create-breadcrumb'" />

    <h2 class="font-serif font-bold text-2xl text-blue-strong">{{ __('admin/volunteers.create_title') }}</h2>

    <form wire:submit="save" class="flex flex-col gap-6 max-w-xl p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
        <x-forms.fieldset title="{{ __('admin/volunteers.personal_info') }}">
            <x-forms.input for="name" type="text" wire:model="name" :required="true">{{ __('admin/volunteers.name') }}</x-forms.input>
            <x-forms.input for="email" type="email" wire:model="email" :required="true">{{ __('admin/volunteers.email') }}</x-forms.input>
            <x-forms.input for="phone" type="text" wire:model="phone">{{ __('admin/volunteers.phone') }}</x-forms.input>
        </x-forms.fieldset>

        <x-forms.fieldset title="{{ __('admin/volunteers.role') }}">
            <div class="flex flex-col gap-2">
                <label for="role" class="font-medium font-serif text-blue-strong">
                    {{ __('admin/volunteers.role') }}
                    <small><abbr class="text-red-normal" title="{{ __('admin/volunteers.required_field') }}">*</abbr></small>
                </label>
                <x-forms.select for="role" wire:model="role" :required="true" class="w-full">
                    @foreach (\App\Enums\UserRole::cases() as $r)
                        <option value="{{ $r->value }}">{{ $r->label() }}</option>
                    @endforeach
                </x-forms.select>
                @error('role') <p class="font-serif text-sm text-red-normal">{{ $message }}</p> @enderror
            </div>
        </x-forms.fieldset>

        <x-forms.fieldset title="{{ __('admin/volunteers.password') }}">
            <x-forms.input for="password" type="password" wire:model="password" :required="true" placeholder="••••••••">{{ __('admin/volunteers.password') }}</x-forms.input>
        </x-forms.fieldset>

        <x-forms.button type="submit" class="bg-red-strong border-red-strong text-white
            hover:bg-white hover:text-red-strong hover:border-red-strong w-fit">
            {{ __('admin/volunteers.submit_create') }}
        </x-forms.button>
    </form>
</div>
