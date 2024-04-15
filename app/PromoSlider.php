<?php

namespace App;

use Event;
use Illuminate\Database\Eloquent\Model;

class PromoSlider extends Model
{

    public static function boot()
    {
        parent::boot();

        static::created(function ($promoSlider) {
            Event::dispatch('promoslider.created', $promoSlider);
        });

        static::updated(function ($promoSlider) {
            Event::dispatch('promoslider.updated', $promoSlider);
        });

        static::deleted(function ($promoSlider) {
            Event::dispatch('promoslider.deleted', $promoSlider);
        });
    }

    /**
     * @return mixed
     */
    public function slides()
    {
        return $this->hasMany('App\Slide')->ordered();
    }

    /**
     * @return mixed
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    /**
     * @return mixed
     */
    public function toggleActive()
    {
        $this->is_active = !$this->is_active;
        return $this;
    }
}
