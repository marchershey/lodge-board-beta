<?php

namespace App\Http\Middleware;

use App\Models\Banner;
use App\Models\Listing;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowHostBannerIfNoListing
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if there is no listing
        if (count(Listing::all()) == 0) {
            // Check if banner already exists
            if (!Banner::where('slug', 'no-listing')->exists()) {
                Banner::create([
                    'slug' => 'no-listing',
                    'title' => 'No Listing Found',
                    'content' => '<strong>You need to add a listing!</strong> Click here to add one.',
                    'type' => 'warning',
                    'link' => route('login'),
                    'location' => 'host',
                    'hideCloseButton' => true,
                ]);
            }
        } else {
            // Since there is a listing, remove the banner
            Banner::where('slug', 'no-listing')->delete();
        }

        return $next($request);
    }
}
