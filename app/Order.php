<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'orderstatus_id' => 'integer',
        'restaurant_charge' => 'float',
        'total' => 'float',
        'payable' => 'float',
        'wallet_amount' => 'float',
        'tip_amount' => 'float',
        'tax_amount' => 'float',
        'coupon_amount' => 'float',
        'sub_total' => 'float',
        'is_ratable' => 'boolean',
    ];

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return mixed
     */
    public function orderstatus()
    {
        return $this->belongsTo('App\Orderstatus');
    }

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
    public function orderitems()
    {
        return $this->hasMany('App\Orderitem');
    }

    /**
     * @return mixed
     */
    public function gpstable()
    {
        return $this->hasOne('App\GpsTable');
    }

    /**
     * @return mixed
     */
    public function accept_delivery()
    {
        return $this->hasOne('App\AcceptDelivery');
    }

    public function is_completed()
    {
        if ($this->orderstatus_id == '5') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return mixed
     */
    public function rating()
    {
        return $this->hasOne('App\Rating');
    }
}
