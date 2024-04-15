<?php

namespace App\Http\Controllers;

use App\Translation;
use Cache;
use Illuminate\Http\Request;
use Modules\SuperCache\SuperCache;
use Nwidart\Modules\Facades\Module;

class LanguageController extends Controller
{
    /**
     * @param $name
     * @param $data
     */
    private function processSuperCache($name, $data = null)
    {
        if (Module::find('SuperCache') && Module::find('SuperCache')->isEnabled()) {
            $superCache = new SuperCache();
            $superCache->cacheResponse($name, $data);
        }
    }

    /**
     * @param Request $request
     */
    public function getAllLanguages(Request $request)
    {
        // Cache::forget('app-languages');

        if (Cache::has('app-languages')) {
            $languages = Cache::get('app-languages');
        } else {
            $languages = Translation::where('is_active', '1')->get(['id', 'language_name', 'is_default']);
            $this->processSuperCache('app-languages', $languages);
        }

        // $languages = Translation::where('is_active', '1')->get(['id', 'language_name', 'is_default']);

        return response()->json($languages);
    }

    /**
     * @param Request $request
     */
    public function getSingleLanguage(Request $request)
    {
        // Cache::forget('app-language-' . $request->id);
        // die();
        if (Cache::has('app-language-' . $request->id)) {
            $language = Cache::get('app-language-' . $request->id);
        } else {
            $language = Translation::where('id', $request->id)->first();
            $this->processSuperCache('app-language-' . $request->id, $language);
        }

        // $language = Translation::where('id', $request->id)->first();

        if ($language) {
            $data = $language->data;
            return response()->json(json_decode($data));
        }
    }
}
