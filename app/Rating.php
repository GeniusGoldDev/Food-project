<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

    /**
     * @var array
     */
    protected $casts = [
        'rating_store' => 'float',
        'rating_delivery' => 'float',
    ];

    /**
     * @return mixed
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
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
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
