<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryCollection extends Model
{
    /**
     * @return mixed
     */
    public function delivery_collection_logs()
    {
        return $this->hasMany('App\DeliveryCollectionLog');
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
