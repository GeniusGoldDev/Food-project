<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Jenssegers\Agent\Agent;
class AgentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $agent = new Agent();
        View::share('agent', $agent);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
