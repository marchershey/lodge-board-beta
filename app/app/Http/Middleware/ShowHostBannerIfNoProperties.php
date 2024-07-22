<?php

namespace App\Http\Middleware;

use App\Models\Banner;
use App\Models\Property;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShowHostBannerIfNoProperties
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if there is no property
        if (count(Property::all()) == 0) {
            // Check if banner already exists
            if (!Banner::where('slug', 'no-property')->exists()) {
                Banner::create([
                    'slug' => 'no-property',
                    'title' => 'You haven\'t added any properties yet!',
                    'description' => 'You can tap this banner to add one.',
                    'type' => 'warning',
                    'link' => route('host.properties.new-property'),
                    'location' => 'host',
                    'hideCloseButton' => true,
                ]);
            }
        } else {
            // Since there is a property, remove the banner
            Banner::where('slug', 'no-property')->delete();
        }

        return $next($request);
    }
}
