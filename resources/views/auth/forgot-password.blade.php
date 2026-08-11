<x-layouts.guest title="Mot de passe oublié">

    <x-public.sections.section title="Mot de passe oublié">
        <p class="font-sans font-normal text-lg text-blue-strong opacity-50 mb-6">
            Indiquez votre adresse email, vous receverez un lien de réinitialisation.
        </p>

        @if (session('status'))
            <p class="font-serif text-sm text-green-600 mb-4">{{ session('status') }}</p>
        @endif

        <form method="POST" action="{{ route('password.email', ['locale' => app()->getLocale()]) }}" class="flex flex-col gap-4 max-w-md">
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
    </x-public.sections.section>

</x-layouts.guest>
