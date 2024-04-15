<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    /**
     * @var array
     */
    protected $dates = ['expiry_date'];

    /**
     * @return mixed
     */
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }

    /**
     * @return mixed
     */
    public function restaurants()
    {
        return $this->belongsToMany(\App\Restaurant::class);
    }
}
