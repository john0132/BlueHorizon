<?php

namespace App\Providers;

use App\Http\Middleware\ContentLocaleMiddleware;
use BezhanSalleh\LanguageSwitch\Events\LocaleChanged;
use BezhanSalleh\LanguageSwitch\Http\Middleware\SwitchLanguageLocale as VendorSwitchLanguageLocale;
use BezhanSalleh\LanguageSwitch\LanguageSwitch;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Modules\Settings\Models\Language;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Override the vendor middleware with our content-locale middleware
        $this->app->bind(VendorSwitchLanguageLocale::class, ContentLocaleMiddleware::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configure available locales for the language switch UI
        $locales = Language::query()
            ->where('is_active', true)
            ->pluck('locale', 'locale')
            ->toArray();

        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) use ($locales) {
            $switch
                ->locales($locales)
                ->renderHook(PanelsRenderHook::PAGE_HEADER_ACTIONS_BEFORE)
                ->displayLocale('en');
        });

        // Keep content locale in sync with the language switch without changing app locale
        Event::listen(LocaleChanged::class, function (LocaleChanged $event): void {
            session(['content_locale' => $event->locale]);
        });

        // Ensure content_locale is initialized on first request
        if (! session()->has('content_locale')) {
            $preferred = request()->cookie('filament_language_switch_locale')
                ?? config('app.locale');
            $allowed = array_keys($locales);
            if (! in_array($preferred, $allowed, true)) {
                $preferred = config('app.locale');
            }
            session(['content_locale' => $preferred]);
        }
    }
}
