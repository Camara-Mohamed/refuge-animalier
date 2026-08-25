<x-layouts.auth title="Réinitialiser le mot de passe - Les Pattes Heureuses">

    <h2 class="font-serif font-black text-2xl md:text-3xl text-blue-strong">Réinitialiser le mot de passe</h2>

    <form method="POST" action="{{ route('password.update', ['locale' => app()->getLocale()]) }}" class="flex flex-col gap-4">
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

</x-layouts.auth>
