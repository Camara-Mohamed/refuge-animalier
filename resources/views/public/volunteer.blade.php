<x-layouts.guest title="{{ __('public/volunteer.title')}}">

    <x-public.sections.intro title="{{ __('public/volunteer.page_title') }}">
        {{ __('public/volunteer.page_subtitle') }}
    </x-public.sections.intro>

    <x-public.sections.hidden_section title="{{ __('public/volunteer.needs_title') }} & {{ __('public/volunteer.form_title') }}">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-20">

            <div class="flex flex-col gap-8">
                <h3 class="text-3xl font-bold font-serif text-blue-strong">{{ __('public/volunteer.needs_title') }}</h3>

                <x-public.sections.volunteer.icon-list class="w-full lg:w-96" :items="[
                    ['icon' => 'clock', 'title' => __('public/volunteer.need_1_title'), 'text' => __('public/volunteer.need_1_content')],
                    ['icon' => 'hand-heart', 'title' => __('public/volunteer.need_2_title'), 'text' => __('public/volunteer.need_2_content')],
                    ['icon' => 'users', 'title' => __('public/volunteer.need_3_title'), 'text' => __('public/volunteer.need_3_content')],
                ]" />
            </div>

            <div class="flex flex-col gap-8 flex-1">
                <h2 class="text-3xl font-bold font-serif text-blue-strong">{{ __('public/volunteer.form_title') }}</h2>

                <div class="p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
                    <x-forms.send></x-forms.send>

                    <form method="POST" action="{{ route('public.volunteer.store', app()->getLocale()) }}" class="flex flex-col gap-6">
                        @csrf

                        <x-forms.fieldset title="{{ __('public/volunteer.personal_info') }}">
                            <x-forms.input for="name" type="text" :required="true">
                                {{ __('public/volunteer.form_name') }}
                            </x-forms.input>

                            <x-forms.input for="email" type="email" :required="true">
                                {{ __('public/volunteer.form_email') }}
                            </x-forms.input>

                            <x-forms.input for="phone" type="tel" :required="true">
                                {{ __('public/volunteer.form_phone') }}
                            </x-forms.input>
                        </x-forms.fieldset>

                        <x-forms.fieldset title="{{ __('public/volunteer.address_info') }}">
                            <div class="grid grid-cols-2 gap-4">
                                <x-forms.input for="address" type="text" :required="true">
                                    {{ __('public/volunteer.form_address') }}
                                </x-forms.input>

                                <x-forms.input for="number" type="text" :required="true">
                                    {{ __('public/volunteer.form_number') }}
                                </x-forms.input>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <x-forms.input for="city" type="text" :required="true">
                                    {{ __('public/volunteer.form_city') }}
                                </x-forms.input>

                                <x-forms.input for="code_postal" type="text" :required="true">
                                    {{ __('public/volunteer.form_postal_code') }}
                                </x-forms.input>
                            </div>
                        </x-forms.fieldset>

                        <x-forms.fieldset title="{{ __('public/volunteer.form_availability') }}">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @foreach(\App\Enums\Day::cases() as $day)
                                    <label class="flex items-center gap-2 p-3 border border-gray-300 rounded-lg cursor-pointer has-checked:bg-red-strong has-checked:text-white has-checked:border-red-strong transition-colors">
                                        <input
                                            type="checkbox"
                                            name="availabilities[]"
                                            value="{{ $day->value }}"
                                            {{ is_array(old('availabilities')) && in_array($day->value, old('availabilities')) ? 'checked' : '' }}
                                            class="sr-only"
                                        >
                                        <span>{{ $day->label() }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('availabilities')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </x-forms.fieldset>

                        <x-forms.button
                            type="submit"
                            class="mt-4 bg-red-strong border-red-strong text-white hover:bg-white hover:text-red-strong hover:border-red-strong"
                        >
                            {{ __('public/volunteer.form_submit') }}
                        </x-forms.button>
                    </form>
                </div>
            </div>
        </div>
    </x-public.sections.hidden_section>

    <x-public.sections.volunteer.feature-cards
        title="{{ __('public/volunteer.benefits_title') }}"
        :cards="[
            ['icon' => 'heart', 'title' => __('public/volunteer.benefit_1_title'), 'text' => __('public/volunteer.benefit_1_content')],
            ['icon' => 'users', 'title' => __('public/volunteer.benefit_2_title'), 'text' => __('public/volunteer.benefit_2_content')],
            ['icon' => 'paw-print', 'title' => __('public/volunteer.benefit_3_title'), 'text' => __('public/volunteer.benefit_3_content')],
        ]">
    </x-public.sections.volunteer.feature-cards>

    <x-public.sections.section title="{{ __('public/volunteer.roles_title') }}">
        <x-public.sections.volunteer.numbered-list :items="[
            ['title' => __('public/volunteer.role_1_title'), 'text' => __('public/volunteer.role_1_content')],
            ['title' => __('public/volunteer.role_2_title'), 'text' => __('public/volunteer.role_2_content')],
            ['title' => __('public/volunteer.role_3_title'), 'text' => __('public/volunteer.role_3_content')],
            ['title' => __('public/volunteer.role_4_title'), 'text' => __('public/volunteer.role_4_content')],
        ]" />
    </x-public.sections.section>

    <section class="py-10 px-6 md:py-12 md:px-12 lg:py-16 lg:px-20 text-blue-strong">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
            <div class="flex flex-col gap-4">
                <h2 class="font-serif font-bold text-2xl md:text-3xl lg:text-4xl">
                    {{ __('public/volunteer.faq_title') }}
                </h2>
                <p class="font-sans font-normal text-lg text-blue-strong opacity-50">
                    {{ __('public/volunteer.faq_subtitle') }}
                </p>
            </div>

            <x-public.sections.faq :faqs="[
                [
                    'question' => 'Faut-il une expérience avec les animaux pour devenir bénévole ?',
                    'answer' => 'Non, aucune <strong>expérience préalable</strong> n\'est requise. Nous formons chaque bénévole selon son rôle et l\'accompagnons dans ses premières missions.',
                ],
                [
                    'question' => 'Combien de temps dois-je m\'engager ?',
                    'answer' => 'Il n\'y a pas de durée minimale imposée. Vous choisissez vos <strong>disponibilités</strong> lors de votre candidature, et vous pouvez les ajuster à tout moment selon votre emploi du temps.',
                ],
                [
                    'question' => 'Que se passe-t-il après l\'envoi de ma candidature ?',
                    'answer' => 'Vous recevez un <strong>email de confirmation</strong>, puis notre équipe vous recontacte pour un premier échange et, si tout convient, la création de votre compte bénévole.',
                ],
            ]"></x-public.sections.faq>
        </div>
    </section>

</x-layouts.guest>
