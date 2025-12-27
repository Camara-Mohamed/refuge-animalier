<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->route('locale');

        if (! in_array($locale, ['fr', 'en', 'nl', 'de'])) {
            abort(404);
        }

        App::setLocale($locale);

        return $next($request);
    }
}
