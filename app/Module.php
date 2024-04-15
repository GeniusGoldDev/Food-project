<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{

    /**
     * @var array
     */
    // protected $casts = [
    //     'update_date' => 'date',
    // ];

    /**
     * @return mixed
     */
    public function toggleActive()
    {
        $this->is_active = !$this->is_active;
        return $this;
    }
}
