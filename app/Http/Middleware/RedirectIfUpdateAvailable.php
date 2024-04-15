<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\File;

class RedirectIfUpdateAvailable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $updateFile = File::exists(storage_path('update'));
        if ($updateFile && !$request->is('install/update')) {
            return redirect('install/update');
        }

        return $next($request);
    }
}
