<?php

namespace App\Http\Middleware;

use BezhanSalleh\LanguageSwitch\LanguageSwitch;
use Closure;
use Illuminate\Http\Request;

class ContentLocaleMiddleware
{
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->is('api/*') || $request->expectsJson()) {
            return $next($request);
        }
        $contentLocale = session('content_locale')
            ?? $request->cookie('filament_language_switch_locale')
            ?? $request->get('locale')
            ?? LanguageSwitch::make()->getUserPreferredLocale()
            ?? config('app.locale');

        // Normalize to one of the allowed locales from the plugin config if possible
        $locales = LanguageSwitch::make()->getLocales();
        if (! empty($locales) && ! in_array($contentLocale, $locales, true)) {
            $contentLocale = config('app.locale');
        }

        session(['content_locale' => $contentLocale]);

        return $next($request);
    }
}
