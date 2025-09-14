@php
    $currentLocale = session('content_locale', config('app.locale'));
@endphp
<x-filament::dropdown
    teleport
    :placement="$placement"
    :width="$isFlagsOnly ? 'w-fit fls-flag-only-width' : 'w-fit fls-dropdown-width'"
    :max-height="$maxHeight"
    class="fi-dropdown fi-user-menu"
    data-nosnippet="true"
>
    <x-slot name="trigger">
        <div
            @class([
                // Select-like outer container
                'language-switch-trigger group inline-flex items-center gap-2 cursor-pointer select-none',
                'h-9 px-2.5 rounded-md border bg-white shadow-sm text-gray-700 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-500',
                'dark:bg-gray-900 dark:text-gray-200 dark:border-white/10 dark:hover:bg-gray-800 dark:hover:border-white/20 dark:focus:ring-primary-400/20',
            ])
            x-tooltip="{
                content: @js($languageSwitch->getLabel($currentLocale)),
                theme: $store.theme,
                placement: 'right'
            }"
        >
            @if ($isFlagsOnly || $hasFlags)
                <x-language-switch::flag
                    :src="$languageSwitch->getFlag($currentLocale)"
                    :circular="$isCircular"
                    :alt="$languageSwitch->getLabel($currentLocale)"
                    :switch="true"
                    class="w-5 h-5"
                />
            @else
                <span
                    @class([
                        'flex items-center justify-center flex-shrink-0 w-5 h-5 text-[11px] font-semibold bg-primary-500/10 text-primary-600 group-hover:bg-primary-500/15',
                        'rounded-full' => $isCircular,
                        'rounded-md' => !$isCircular,
                    ])
                >
                    {{ $languageSwitch->getCharAvatar($currentLocale) }}
                </span>
            @endif
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.29a.75.75 0 01.02-1.08z" clip-rule="evenodd" />
            </svg>
        </div>
    </x-slot>

    <x-filament::dropdown.list @class(['!border-t-0 space-y-1 !p-2.5'])>
        @foreach ($locales as $locale)
            @if ($locale !== $currentLocale)
                <button
                    type="button"
                    wire:click="changeLocale('{{ $locale }}')"
                    @if ($isFlagsOnly)
                    x-tooltip="{
                        content: @js($languageSwitch->getLabel($locale)),
                        theme: $store.theme,
                        placement: 'right'
                    }"
                    @endif

                    @class([
                        'flex items-center w-full transition-colors duration-75 rounded-md outline-none fi-dropdown-list-item whitespace-nowrap disabled:pointer-events-none disabled:opacity-70 fi-dropdown-list-item-color-gray hover:bg-gray-950/5 focus:bg-gray-950/5 dark:hover:bg-white/5 dark:focus:bg-white/5',
                        'justify-center px-2 py-0.5' => $isFlagsOnly,
                        'justify-start space-x-2 rtl:space-x-reverse p-1' => !$isFlagsOnly,
                    ])
                >

                    @if ($isFlagsOnly)
                        <x-language-switch::flag
                            :src="$languageSwitch->getFlag($locale)"
                            :circular="$isCircular"
                            :alt="$languageSwitch->getLabel($locale)"
                            class="w-7 h-7"
                        />
                    @else
                        @if ($hasFlags)
                            <x-language-switch::flag
                                :src="$languageSwitch->getFlag($locale)"
                                :circular="$isCircular"
                                :alt="$languageSwitch->getLabel($locale)"
                                class="w-7 h-7"
                            />
                        @else
                            <span
                                @class([
                                    'flex items-center justify-center flex-shrink-0 w-7 h-7 p-2 text-xs font-semibold group-hover:bg-white group-hover:text-primary-600 group-hover:border group-hover:border-primary-500/10 group-focus:text-white bg-primary-500/10 text-primary-600',
                                    'rounded-full' => $isCircular,
                                    'rounded-lg' => !$isCircular,
                                ])
                            >
                                {{ $languageSwitch->getCharAvatar($locale) }}
                            </span>
                        @endif
                        <span class="text-sm font-medium text-gray-600 hover:bg-transparent dark:text-gray-200">
                            {{ $languageSwitch->getLabel($locale) }}
                        </span>

                    @endif
                </button>
            @endif
        @endforeach
    </x-filament::dropdown.list>
</x-filament::dropdown>
