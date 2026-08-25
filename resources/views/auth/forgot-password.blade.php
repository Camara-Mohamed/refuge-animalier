<x-layouts.auth title="Mot de passe oublié - Les Pattes Heureuses">

    <a href="{{ route('login', ['locale' => app()->getLocale()]) }}" class="font-serif text-sm text-red-normal hover:underline">
        ← Retour à la connexion
    </a>

    <h2 class="font-serif font-black text-2xl md:text-3xl text-blue-strong">Mot de passe oublié</h2>

    <p class="font-sans font-normal text-blue-strong opacity-70">
        Indiquez votre adresse email, vous recevrez un lien de réinitialisation.
    </p>

    @if (session('status'))
        <p class="p-4 bg-blue-strong/10 border border-blue-strong text-blue-strong rounded-lg font-sans text-sm">
            {{ session('status') }}
        </p>
    @endif

    <form method="POST" action="{{ route('password.email', ['locale' => app()->getLocale()]) }}" class="flex flex-col gap-4">
        @csrf

        <x-forms.input for="email" required="true" type="email" placeholder="jean.dupont@lespattesheureuses.com">
            Adresse email
        </x-forms.input>

        <x-forms.button
            type="submit"
            class="bg-red-strong border-red-strong text-white hover:bg-white hover:text-red-strong hover:border-red-strong"
        >
            Envoyer le lien de réinitialisation
        </x-forms.button>
    </form>

</x-layouts.auth>
