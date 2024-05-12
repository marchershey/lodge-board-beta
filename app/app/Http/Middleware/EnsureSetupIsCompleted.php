<?php

namespace App\Http\Middleware;

use App\Settings\GeneralSettings;
use App\Settings\SetupSettings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSetupIsCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app(SetupSettings::class)->completed === false) {
            return redirect()->route('setup');
        }

        return $next($request);
    }
}
