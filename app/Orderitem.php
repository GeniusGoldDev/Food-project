<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function order_item_addons()
    {
        return $this->hasMany('App\OrderItemAddon');
    }
}
