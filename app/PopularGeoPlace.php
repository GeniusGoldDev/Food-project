<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopularGeoPlace extends Model
{
    /**
     * @return mixed
     */
    public function toggleActive()
    {
        $this->is_active = !$this->is_active;
        return $this;
    }
}
