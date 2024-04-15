<?php

namespace App;

use Event;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Slide extends Model implements Sortable
{
    use SortableTrait;

    /**
     * @var array
     */
    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($slide) {
            Event::dispatch('slide.created', $slide);
        });

        static::updated(function ($slide) {
            Event::dispatch('slide.updated', $slide);
        });

        static::deleted(function ($slide) {
            Event::dispatch('slide.deleted', $slide);
        });
    }

    /**
     * @return mixed
     */
    public function promo_slider()
    {
        return $this->belongsTo('App\PromoSlider');
    }

    /**
     * @return mixed
     */
    public function toggleActive()
    {
        $this->is_active = !$this->is_active;
        return $this;
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
