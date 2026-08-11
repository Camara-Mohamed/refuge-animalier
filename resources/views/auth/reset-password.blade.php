<x-layouts.guest title="Réinitialiser le mot de passe - Les Pattes Heureuses">

    <x-public.sections.section title="Réinitialiser le mot de passe">
        <form method="POST" action="{{ route('password.update', ['locale' => app()->getLocale()]) }}" class="flex flex-col gap-4 max-w-md">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <x-forms.input for="email" required="true" type="email" placeholder="jean.dupont@lespattesheureuses.com" :value="$request->email">
                Adresse email
            </x-forms.input>

            <x-forms.input for="password" required="true" type="password" placeholder="••••••••">
                Nouveau mot de passe
            </x-forms.input>

            <x-forms.input for="password_confirmation" required="true" type="password" placeholder="••••••••">
                Confirmer le mot de passe
            </x-forms.input>

            <x-forms.button
                type="submit"
                class="bg-red-strong border-red-strong text-white hover:bg-white hover:text-red-strong hover:border-red-strong"
            >
                Réinitialiser le mot de passe
            </x-forms.button>
        </form>
    </x-public.sections.section>

</x-layouts.guest>
