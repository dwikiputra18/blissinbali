<?php

namespace App\Http\Middleware;

use App\Models\Site;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCurrentSite
{
    public function handle(Request $request, Closure $next): Response
    {
        $siteId = env('APP_WEBSITE_ID');
        $site = $siteId
            ? Site::where('id', $siteId)->where('is_active', true)->first()
            : null;

        if (!$site) {
            $domain = $request->getHost();
            $site = Site::where('domain', $domain)->where('is_active', true)->first();
        }

        if ($site) {
            config(['app.site_id' => $site->id]);
            config(['app.site'    => $site]);
        } else {
            config(['app.site_id' => 4]);
            config(['app.site'    => (object) ['id' => 4, 'prefix' => 'ZBT', 'name' => config('app.name')]]);
        }

        return $next($request);
    }
}
