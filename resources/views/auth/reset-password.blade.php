<x-layouts.guest title="Réinitialiser le mot de passe - Les Pattes Heureuses">

    <x-public.sections.section class="items-center" title="Réinitialiser le mot de passe">
        <div class="w-full max-w-md p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
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
        </div>
    </x-public.sections.section>

</x-layouts.guest>
