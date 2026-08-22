<x-layouts.guest title="{{ __('public/volunteer.title')}}" >

    <x-public.sections.intro title="{{ __('public/volunteer.page_title') }}">
        {{ __('public/volunteer.page_subtitle') }}
    </x-public.sections.intro>

    <x-public.sections.hidden_section title="{{ __('public/volunteer.needs_title') }} & {{ __('public/volunteer.form_title') }}">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-20">

            <div class="flex flex-col gap-8">
                <h3 class="text-3xl font-bold font-serif text-blue-strong">{{ __('public/volunteer.needs_title') }}</h3>

                <div class="flex flex-col gap-4 w-full lg:w-96">
                    @php
                        $needs = [
                            ['icon' => 'clock', 'title' => __('public/volunteer.need_1_title'), 'text' => __('public/volunteer.need_1_content')],
                            ['icon' => 'hand-heart', 'title' => __('public/volunteer.need_2_title'), 'text' => __('public/volunteer.need_2_content')],
                            ['icon' => 'users', 'title' => __('public/volunteer.need_3_title'), 'text' => __('public/volunteer.need_3_content')],
                        ];
                    @endphp

                    @foreach ($needs as $need)
                        <div class="p-6 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] outline outline-1 outline-offset-[-1px] outline-blue-strong/10 flex gap-6 items-start">
                            <div class="w-12 h-12 shrink-0 p-3 bg-red-strong rounded-2xl flex justify-center items-center">
                                <x-dynamic-component :component="'icons.' . $need['icon']" class="fill-white" />
                            </div>
                            <div class="flex flex-col gap-2">
                                <h4 class="font-serif font-bold text-base text-blue-strong">{{ $need['title'] }}</h4>
                                <p class="font-sans text-base text-blue-strong opacity-70">{{ $need['text'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col gap-8 flex-1">
                <h2 class="text-3xl font-bold font-serif text-blue-strong">{{ __('public/volunteer.form_title') }}</h2>

                <div class="p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
                    <x-forms.send></x-forms.send>

                    <form method="POST" action="{{ route('public.volunteer.store', app()->getLocale()) }}" class="flex flex-col gap-4">
                        @csrf

                        <div class="flex flex-col gap-2">
                            <label for="name" class="text-blue-strong font-medium">
                                {{ __('public/volunteer.form_name') }}
                                <abbr title="{{ __('public/form.abbr_require') }}" class="text-red-strong no-underline">*</abbr>
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-strong @error('name') border-red-500 @enderror"
                            >
                            @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-blue-strong font-medium">
                                {{ __('public/volunteer.form_email') }}
                                <abbr title="{{ __('public/form.abbr_require') }}" class="text-red-strong no-underline">*</abbr>
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-strong @error('email') border-red-500 @enderror"
                            >
                            @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="phone" class="text-blue-strong font-medium">
                                {{ __('public/volunteer.form_phone') }}
                                <abbr title="{{ __('public/form.abbr_require') }}" class="text-red-strong no-underline">*</abbr>
                            </label>
                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                value="{{ old('phone') }}"
                                required
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-strong @error('phone') border-red-500 @enderror"
                            >
                            @error('phone')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="address" class="text-blue-strong font-medium">
                                    {{ __('public/volunteer.form_address') }}
                                    <abbr title="{{ __('public/form.abbr_require') }}" class="text-red-strong no-underline">*</abbr>
                                </label>
                                <input
                                    type="text"
                                    id="address"
                                    name="address"
                                    value="{{ old('address') }}"
                                    required
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-strong @error('address') border-red-500 @enderror"
                                >
                                @error('address')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="number" class="text-blue-strong font-medium">
                                    {{ __('public/volunteer.form_number') }}
                                    <abbr title="{{ __('public/form.abbr_require') }}" class="text-red-strong no-underline">*</abbr>
                                </label>
                                <input
                                    type="text"
                                    id="number"
                                    name="number"
                                    value="{{ old('number') }}"
                                    required
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-strong @error('number') border-red-500 @enderror"
                                >
                                @error('number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col gap-2">
                                <label for="city" class="text-blue-strong font-medium">
                                    {{ __('public/volunteer.form_city') }}
                                    <abbr title="{{ __('public/form.abbr_require') }}" class="text-red-strong no-underline">*</abbr>
                                </label>
                                <input
                                    type="text"
                                    id="city"
                                    name="city"
                                    value="{{ old('city') }}"
                                    required
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-strong @error('city') border-red-500 @enderror"
                                >
                                @error('city')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex flex-col gap-2">
                                <label for="code_postal" class="text-blue-strong font-medium">
                                    {{ __('public/volunteer.form_postal_code') }}
                                    <abbr title="{{ __('public/form.abbr_require') }}" class="text-red-strong no-underline">*</abbr>
                                </label>
                                <input
                                    type="text"
                                    id="code_postal"
                                    name="code_postal"
                                    value="{{ old('code_postal') }}"
                                    required
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-strong @error('code_postal') border-red-500 @enderror"
                                >
                                @error('code_postal')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-blue-strong font-medium">{{ __('public/volunteer.form_availability') }}</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @foreach(\App\Enums\Day::cases() as $day)
                                    <label class="flex items-center gap-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-strong/5">
                                        <input
                                            type="checkbox"
                                            name="availabilities[]"
                                            value="{{ $day->value }}"
                                            {{ is_array(old('availabilities')) && in_array($day->value, old('availabilities')) ? 'checked' : '' }}
                                            class="w-4 h-4 text-red-strong border-gray-300 rounded focus:ring-red-strong"
                                        >
                                        <span class="text-blue-strong">{{ $day->label() }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('availabilities')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

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

    <x-public.sections.feature-cards
        title="{{ __('public/volunteer.benefits_title') }}"
        :cards="[
            ['icon' => 'heart', 'title' => __('public/volunteer.benefit_1_title'), 'text' => __('public/volunteer.benefit_1_content')],
            ['icon' => 'users', 'title' => __('public/volunteer.benefit_2_title'), 'text' => __('public/volunteer.benefit_2_content')],
            ['icon' => 'paw-print', 'title' => __('public/volunteer.benefit_3_title'), 'text' => __('public/volunteer.benefit_3_content')],
        ]">
    </x-public.sections.feature-cards>

    <x-public.sections.section title="{{ __('public/volunteer.roles_title') }}">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex gap-4 p-6 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] outline outline-1 outline-offset-[-1px] outline-blue-strong/10">
                <div class="w-10 h-10 bg-red-strong rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold">1</span>
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="text-lg font-bold text-blue-strong">{{ __('public/volunteer.role_1_title') }}</h3>
                    <p class="text-blue-strong opacity-70">{{ __('public/volunteer.role_1_content') }}</p>
                </div>
            </div>

            <div class="flex gap-4 p-6 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] outline outline-1 outline-offset-[-1px] outline-blue-strong/10">
                <div class="w-10 h-10 bg-red-strong rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold">2</span>
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="text-lg font-bold text-blue-strong">{{ __('public/volunteer.role_2_title') }}</h3>
                    <p class="text-blue-strong opacity-70">{{ __('public/volunteer.role_2_content') }}</p>
                </div>
            </div>

            <div class="flex gap-4 p-6 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] outline outline-1 outline-offset-[-1px] outline-blue-strong/10">
                <div class="w-10 h-10 bg-red-strong rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold">3</span>
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="text-lg font-bold text-blue-strong">{{ __('public/volunteer.role_3_title') }}</h3>
                    <p class="text-blue-strong opacity-70">{{ __('public/volunteer.role_3_content') }}</p>
                </div>
            </div>

            <div class="flex gap-4 p-6 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] outline outline-1 outline-offset-[-1px] outline-blue-strong/10">
                <div class="w-10 h-10 bg-red-strong rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold">4</span>
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="text-lg font-bold text-blue-strong">{{ __('public/volunteer.role_4_title') }}</h3>
                    <p class="text-blue-strong opacity-70">{{ __('public/volunteer.role_4_content') }}</p>
                </div>
            </div>
        </div>
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
