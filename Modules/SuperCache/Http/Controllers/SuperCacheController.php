<?php

namespace Modules\SuperCache\Http\Controllers;

use Artisan;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class SuperCacheController extends Controller
{
    const storesCacheKeys = [
        'stores-delivery-active',
        'stores-delivery-inactive',
        'stores-selfpickup-active',
        'stores-selfpickup-inactive',
    ];

    const itemsCacheKeys = [
        'items-cache',
    ];

    const languagesCacheKeys = [
        'app-languages',
    ];

    const slidersCacheKeys = [
        'main-slider',
        'other-position-slider',
    ];

    const settingsCacheKeys = [
        'app-settings',
    ];

    public function settings()
    {
        //get num of cache folders
        // $cacheObjects = count(glob(storage_path('/framework/cache/data/*'), GLOB_ONLYDIR));

        foreach (self::storesCacheKeys as $key) {
            $storesCacheKeys = Cache::has($key);
            if ($storesCacheKeys) {
                break;
            }
        }

        foreach (self::itemsCacheKeys as $key) {
            $itemsCacheKeys = Cache::has($key);
            if ($itemsCacheKeys) {
                break;
            }
        }

        foreach (self::languagesCacheKeys as $key) {
            $languagesCacheKeys = Cache::has($key);
            if ($languagesCacheKeys) {
                break;
            }
        }

        foreach (self::slidersCacheKeys as $key) {
            $slidersCacheKeys = Cache::has($key);
            if ($slidersCacheKeys) {
                break;
            }
        }

        foreach (self::settingsCacheKeys as $key) {
            $settingsCacheKeys = Cache::has($key);
            if ($settingsCacheKeys) {
                break;
            }
        }

        return view('supercache::settings', array(
            'storesCacheKeys' => $storesCacheKeys,
            'itemsCacheKeys' => $itemsCacheKeys,
            'languagesCacheKeys' => $languagesCacheKeys,
            'slidersCacheKeys' => $slidersCacheKeys,
            'settingsCacheKeys' => $settingsCacheKeys,
        ));
    }

/**
 * @param $cacheName
 */
    public function purgeCache()
    {
        Artisan::call('cache:clear');
        return redirect()->route('supercache.settings')->with(['success' => 'Cache purged successfully']);
    }

}
