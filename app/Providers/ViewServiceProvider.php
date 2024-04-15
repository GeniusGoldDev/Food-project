<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['admin.*'], function ($view) {
            $elFlag = File::exists(base_path('vendor/bin/elflag'));
            if ($elFlag) {
                session()->put('elflag', true);
            } else {
                session()->put('elflag', false);
            }
        });
    }
}
