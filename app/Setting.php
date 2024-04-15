<?php

namespace App;

use Event;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * @var mixed
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $hidden = array('created_at', 'updated_at');

    public static function boot()
    {
        parent::boot();

        static::updated(function ($setting) {
            Event::dispatch('setting.updated', $setting);
        });

    }

}
