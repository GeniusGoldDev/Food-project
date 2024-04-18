<?php

namespace Modules\SuperCache;

use App\Restaurant;
use Cache;

class SuperCache
{
    /**
     * @param $req
     */
    public function cacheResponse($cacheName, $req = null)
    {
        return Cache::remember($cacheName, 3500, function () use ($req) {
            return $req;
        });
    }
}
