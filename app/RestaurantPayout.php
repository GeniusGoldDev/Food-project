<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantPayout extends Model
{
    /**
     * @return mixed
     */
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }
}
