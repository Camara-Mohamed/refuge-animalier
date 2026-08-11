<x-layouts.guest title="Connexion">

    <x-public.sections.section title="Connexion">
        <form method="POST" action="{{ route('login', ['locale' => app()->getLocale()]) }}" class="flex flex-col gap-4 max-w-md">
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
    </x-public.sections.section>

</x-layouts.guest>
