<x-layouts.guest title="Mot de passe oublié - Les Pattes Heureuses">

    <x-public.sections.section class="items-center" title="Mot de passe oublié">
        <div class="w-full max-w-md p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
            <p class="font-sans font-normal text-blue-strong opacity-70 mb-6">
                Indiquez votre adresse email, vous recevrez un lien de réinitialisation.
            </p>

            @if (session('status'))
                <p class="mb-4 p-4 bg-blue-strong/10 border border-blue-strong text-blue-strong rounded-lg font-sans text-sm">
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
        </div>
    </x-public.sections.section>

</x-layouts.guest>
