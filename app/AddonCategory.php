<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddonCategory extends Model
{
    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function addons()
    {
        return $this->hasMany('App\Addon');
    }
}
