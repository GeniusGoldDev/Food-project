<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcceptDelivery extends Model
{

    protected $casts = ['is_complete' => 'integer'];

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
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}
