<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    /**
     * @return mixed
     */
    public function addon_category()
    {
        return $this->belongsTo('App\AddonCategory');
    }

    /**
     * @return mixed
     */
    public function toggleActive()
    {
        $this->is_active = !$this->is_active;
        return $this;
    }
}
