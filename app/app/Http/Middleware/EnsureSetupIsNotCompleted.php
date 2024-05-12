<?php

namespace App\Http\Middleware;

use App\Settings\SetupSettings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSetupIsNotCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (app(SetupSettings::class)->completed) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
