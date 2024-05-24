<?php

namespace App\Http\Middleware;

use App\Models\Banner;
use App\Models\Rental;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowBannerIfNoRental
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if there is no rental
        if (Rental::all()) {
            // Check if banner already exists
            if (!Banner::where('slug', 'no-rental')->exists()) {
                Banner::create([
                    'slug' => 'no-rental',
                    'content' => '<strong>You need to add a rental!</strong> Click here to add one.',
                    'type' => 'warning',
                    'link' => route('login'),
                ]);
            }
        }

        return $next($request);
    }
}
