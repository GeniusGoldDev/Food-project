<?php

namespace Modules\SuperCache\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class PurgeCacheServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $listen = [

        'itemcategory.created' => [
            'Modules\SuperCache\Events\ItemCategoryEvent@itemCategoryCreated',
        ],

        'itemcategory.updated' => [
            'Modules\SuperCache\Events\ItemCategoryEvent@itemCategoryUpdated',
        ],

        'itemcategory.deleted' => [
            'Modules\SuperCache\Events\ItemCategoryEvent@itemCategoryDeleted',
        ],

        'item.created' => [
            'Modules\SuperCache\Events\ItemEvent@itemCreated',
        ],

        'item.updated' => [
            'Modules\SuperCache\Events\ItemEvent@itemUpdated',
        ],

        'item.deleted' => [
            'Modules\SuperCache\Events\ItemEvent@itemDeleted',
        ],

        'store.created' => [
            'Modules\SuperCache\Events\StoreEvent@storeCreated',
        ],

        'store.updated' => [
            'Modules\SuperCache\Events\StoreEvent@storeUpdated',
        ],

        'store.deleted' => [
            'Modules\SuperCache\Events\StoreEvent@storeDeleted',
        ],

        'language.created' => [
            'Modules\SuperCache\Events\LanguageEvent@languageCreated',
        ],

        'language.updated' => [
            'Modules\SuperCache\Events\LanguageEvent@languageUpdated',
        ],

        'language.deleted' => [
            'Modules\SuperCache\Events\LanguageEvent@languageDeleted',
        ],

        'promoslider.created' => [
            'Modules\SuperCache\Events\PromoSliderEvent@promoSliderCreated',
        ],

        'promoslider.updated' => [
            'Modules\SuperCache\Events\PromoSliderEvent@promoSliderUpdated',
        ],

        'promoslider.deleted' => [
            'Modules\SuperCache\Events\PromoSliderEvent@promoSliderDeleted',
        ],

        'slide.created' => [
            'Modules\SuperCache\Events\PromoSliderEvent@slideCreated',
        ],

        'slide.updated' => [
            'Modules\SuperCache\Events\PromoSliderEvent@slideUpdated',
        ],

        'slide.deleted' => [
            'Modules\SuperCache\Events\PromoSliderEvent@slideDeleted',
        ],

        'setting.updated' => [
            'Modules\SuperCache\Events\SettingEvent@settingUpdated',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
