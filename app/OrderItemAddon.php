<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItemAddon extends Model
{

    public function orderitem()
    {
        return $this->belongsTo('App\Orderitem');
    }
}
