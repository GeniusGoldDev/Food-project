<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryCollectionLog extends Model
{
    /**
     * @return mixed
     */
    public function delivery_collection()
    {
        return $this->belongsTo('App\DeliveryCollection');
    }
}
