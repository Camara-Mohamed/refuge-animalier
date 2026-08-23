<x-layouts.guest title="{{ __('public/contact.title')}}">

    <x-public.sections.intro title="{{ __('public/contact.page_title') }}">
        {{ __('public/contact.page_subtitle') }}
    </x-public.sections.intro>

    <x-public.sections.hidden_section title="{{ __('public/contact.page_title') }}">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-20">

            <div class="flex flex-col gap-12">
                <h3 class="text-3xl font-bold font-serif text-blue-strong">{{ __('public/contact.info_title') }}</h3>

                <x-public.sections.contact.coordinate></x-public.sections.contact.coordinate>
            </div>

            <div class="flex flex-col gap-12 flex-1">
                <h2 class="text-3xl font-bold font-serif text-blue-strong">{{ __('public/contact.form_title') }}</h2>

                <div class="p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
                    <x-forms.send></x-forms.send>

                    <form method="POST" action="{{ route('public.contact.store', app()->getLocale()) }}" class="flex
                    flex-col gap-4">

                        @csrf
                        <x-forms.input for="name" required="true" type="text" placeholder="Alessio Adam">
                            {{ __('public/contact.form_name') }}
                        </x-forms.input>

                        <x-forms.input for="email" required="true" type="email" placeholder="alessio.adam@lespattesheureuses.com">
                            {{ __('public/contact.form_email') }}
                        </x-forms.input>

                        <x-forms.input for="subject" required="true" type="text" placeholder="Comment puis-je devenir bénévole ?">
                            {{ __('public/contact.form_subject') }}
                        </x-forms.input>

                        <x-forms.textarea
                            for="message"
                            required="true"
                            placeholder="{{ __('public/contact.form_message') }}"
                        >
                            {{ __('public/contact.form_message') }}
                        </x-forms.textarea>

                        <x-forms.button
                            type="submit"
                            class="bg-red-strong border-red-strong text-white hover:bg-white hover:text-red-strong hover:border-red-strong"
                        >
                            {{ __('public/contact.form_submit') }}
                        </x-forms.button>
                    </form>
                </div>
            </div>
        </div>
    </x-public.sections.hidden_section>

    {{--
    <x-public.sections.section title="FAQ - Questions & réponses">
        <x-public.sections.faq></x-public.sections.faq>
    </x-public.sections.section>
    --}}

</x-layouts.guest>
