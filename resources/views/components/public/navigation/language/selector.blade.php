<label for="selectLocal" class="sr-only">Langue du site</label>

<div class="relative">
    <select
        id="select-local"
        name="selectLocal"
        class="
            appearance-none
            bg-transparent
            py-2 pl-3 pr-3
            font-sans font-semibold text-[0.825rem]
            text-blue-strong
            cursor-pointer
            transition-colors duration-300

            hover:text-red-strong
            focus:text-red-strong
            focus:outline-none
        "
    >
        <option value="{{ __('public/navigation/lang.fr') }}" selected title="{{ __('public/navigation/lang.switch_fr')
        }}">{{ __('public/navigation/lang.fr')
        }}</option>
        <option  value="{{ __('public/navigation/lang.en') }}" title="{{ __('public/navigation/lang.switch_en')
        }}">{{ __('public/navigation/lang.en')
        }}</option>
        <option  value="{{ __('public/navigation/lang.nl') }}" title="{{ __('public/navigation/lang.switch_nl')
        }}">{{ __('public/navigation/lang.nl')
        }}</option>
        <option value="{{ __('public/navigation/lang.de') }}" title="{{ __('public/navigation/lang.switch_de')
        }}">{{ __('public/navigation/lang.de')
        }}</option>
    </select>
</div>
