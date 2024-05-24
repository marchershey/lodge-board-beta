<?php

namespace App\Http\Middleware;

use App\Models\Banner;
use App\Models\Rental;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowHostBannerIfNoRental
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if there is no rental
        if (count(Rental::all()) == 0) {
            // Check if banner already exists
            if (!Banner::where('slug', 'no-rental')->exists()) {
                Banner::create([
                    'slug' => 'no-rental',
                    'title' => 'No Rental Property Found',
                    'content' => '<strong>You need to add a rental!</strong> Click here to add one.',
                    'type' => 'warning',
                    'link' => route('login'),
                    'location' => 'host',
                    'hideCloseButton' => true,
                ]);
            }
        } else {
            // Since there is a rental, remove the banner
            Banner::where('slug', 'no-rental')->delete();
        }

        return $next($request);
    }
}
