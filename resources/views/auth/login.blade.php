<x-layouts.guest title="Connexion - Les Pattes Heureuses">

    <x-public.sections.section class="items-center" title="Connexion">
        <div class="w-full max-w-md p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
            <form method="POST" action="{{ route('login', ['locale' => app()->getLocale()]) }}" class="flex flex-col gap-4">
                @csrf

                <x-forms.input for="email" required="true" type="email" placeholder="jean.dupont@lespattesheureuses.com">
                    Adresse email
                </x-forms.input>

                <x-forms.input for="password" required="true" type="password" placeholder="********">
                    Mot de passe
                </x-forms.input>

                <label class="flex items-center gap-2 font-serif text-sm text-blue-strong">
                    <input type="checkbox" name="remember">
                    Se souvenir de moi
                </label>

                <a href="{{ route('password.request', ['locale' => app()->getLocale()]) }}" class="font-serif text-sm text-red-normal hover:underline">
                    Mot de passe oublié ?
                </a>

                <x-forms.button
                    type="submit"
                    class="bg-red-strong border-red-strong text-white hover:bg-white hover:text-red-strong hover:border-red-strong"
                >
                    Se connecter
                </x-forms.button>
            </form>
        </div>
    </x-public.sections.section>

</x-layouts.guest>
