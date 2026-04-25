<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * The supported locales.
     */
    protected array $supported = ['en', 'fr'];

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check session first
        if ($request->session()->has('locale')) {
            $locale = $request->session()->get('locale');
        } elseif ($request->cookies->has('locale')) {
            // 2. Then check cookie set by language switcher
            $locale = $request->cookies->get('locale');
        } else {
            // 3. Fall back to browser's Accept-Language header
            $browserLocale = $request->getPreferredLanguage($this->supported);
            $locale = $browserLocale ?? config('app.locale', 'en');
        }

        // Ensure the locale is supported; default to app locale if not
        if (! in_array($locale, $this->supported)) {
            $locale = config('app.locale', 'en');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
