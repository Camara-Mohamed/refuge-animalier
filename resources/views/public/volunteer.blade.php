<x-layouts.guest title="{{ __('public/volunteer.title')}}" >

    <x-public.sections.section title="{{ __('public/volunteer.page_title') }}">
        <p class="font-sans font-normal text-lg text-blue-strong opacity-50">
            {{ __('public/volunteer.page_subtitle') }}
        </p>
    </x-public.sections.section>

    <x-public.sections.section title="{{ __('public/volunteer.benefits_title') }}">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex flex-col gap-4 p-6 bg-white rounded-lg border border-gray-200">
                <div class="w-12 h-12 bg-red-strong rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-blue-strong">{{ __('public/volunteer.benefit_1_title') }}</h3>
                <p class="text-blue-strong opacity-50">{{ __('public/volunteer.benefit_1_content') }}</p>
            </div>

            <div class="flex flex-col gap-4 p-6 bg-white rounded-lg border border-gray-200">
                <div class="w-12 h-12 bg-red-strong rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-blue-strong">{{ __('public/volunteer.benefit_2_title') }}</h3>
                <p class="text-blue-strong opacity-50">{{ __('public/volunteer.benefit_2_content') }}</p>
            </div>

            <div class="flex flex-col gap-4 p-6 bg-white rounded-lg border border-gray-200">
                <div class="w-12 h-12 bg-red-strong rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-blue-strong">{{ __('public/volunteer.benefit_3_title') }}</h3>
                <p class="text-blue-strong opacity-50">{{ __('public/volunteer.benefit_3_content') }}</p>
            </div>
        </div>
    </x-public.sections.section>

    <x-public.sections.section title="{{ __('public/volunteer.roles_title') }}">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex gap-4 p-6 bg-blue-strong/5 rounded-lg">
                <div class="w-10 h-10 bg-red-strong rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold">1</span>
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="text-lg font-bold text-blue-strong">{{ __('public/volunteer.role_1_title') }}</h3>
                    <p class="text-blue-strong opacity-70">{{ __('public/volunteer.role_1_content') }}</p>
                </div>
            </div>

            <div class="flex gap-4 p-6 bg-blue-strong/5 rounded-lg">
                <div class="w-10 h-10 bg-red-strong rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold">2</span>
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="text-lg font-bold text-blue-strong">{{ __('public/volunteer.role_2_title') }}</h3>
                    <p class="text-blue-strong opacity-70">{{ __('public/volunteer.role_2_content') }}</p>
                </div>
            </div>

            <div class="flex gap-4 p-6 bg-blue-strong/5 rounded-lg">
                <div class="w-10 h-10 bg-red-strong rounded-full flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-bold">3</span>
                </div>
                <div class="flex flex-col gap-2">
                    <h3 class="text-lg font-bold text-blue-strong">{{ __('public/volunteer.role_3_title') }}</h3>
                    <p class="text-blue-strong opacity-70">{{ __('public/volunteer.role_3_content') }}</p>
                </div>
            </div>

            <div class="flex gap-4 p-6 bg-blue-strong/5 rounded-lg">
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

    <section class="pb-20 px-20">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-4xl font-bold text-blue-strong text-center mb-4">{{ __('public/volunteer.form_title') }}</h2>
            <p class="text-center text-blue-strong opacity-70 mb-8">{{ __('public/volunteer.form_subtitle') }}</p>

            @if(session('success'))
                <div class="p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('public.volunteer.store', app()->getLocale()) }}" class="flex flex-col gap-4 p-8 bg-white rounded-lg shadow-lg">
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
                        @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                            <label class="flex items-center gap-2 p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-strong/5">
                                <input
                                    type="checkbox"
                                    name="availabilities[]"
                                    value="{{ $day }}"
                                    {{ is_array(old('availabilities')) && in_array($day, old('availabilities')) ? 'checked' : '' }}
                                    class="w-4 h-4 text-red-strong border-gray-300 rounded focus:ring-red-strong"
                                >
                                <span class="text-blue-strong">{{ __('public/volunteer.days.' . $day) }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('availabilities')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <x-buttons.button
                    type="submit"
                    class="mt-4 bg-red-strong border-red-strong text-white hover:bg-white hover:text-red-strong hover:border-red-strong"
                >
                    {{ __('public/volunteer.form_submit') }}
                </x-buttons.button>
            </form>
        </div>
    </section>

</x-layouts.guest>
