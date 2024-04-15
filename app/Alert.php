<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{

    /**
     * @var array
     */
    protected $casts = ['is_read' => 'integer'];
}
