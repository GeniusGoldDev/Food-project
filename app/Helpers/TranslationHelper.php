<?php

namespace App\Helpers;

use App\Translation;

class TranslationHelper
{

    /**
     * @return mixed
     */
    public function getDefaultTranslation()
    {
        $translation = Translation::where('is_default', '1')->first();
        return $translation;
    }

    /**
     * @param $key
     */
    public function getDefaultLanguageValuesForKeys($keys)
    {
        $translation = Translation::where('is_default', '1')->first();
        $decoded = json_decode($translation->data);
        $arr = [];
        foreach ($keys as $key) {
            if (isset($decoded->$key)) {
                $arr[$key] = $decoded->$key;
            } else {
                $arr[$key] = null;
            }
        }
        $data = (object) $arr;
        return $data;
    }
}
