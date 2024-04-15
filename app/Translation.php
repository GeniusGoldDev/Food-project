<?php

namespace App;

use Event;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'is_default' => 'integer',
    ];

    public static function boot()
    {
        parent::boot();

        static::created(function ($translation) {
            Event::dispatch('language.created', $translation);
        });

        static::updated(function ($translation) {
            Event::dispatch('language.updated', $translation);
        });

        static::deleted(function ($translation) {
            Event::dispatch('language.deleted', $translation);
        });
    }

    /**
     * @return mixed
     */
    public function toggleEnable()
    {
        $this->is_active = !$this->is_active;
        return $this;
    }

}
