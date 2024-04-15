<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderstatus extends Model
{
    /**
     * @var mixed
     */

    protected $casts = ['id' => 'integer'];

    public $timestamps = false;
    /**
     * @return mixed
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
