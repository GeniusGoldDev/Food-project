<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    public function toggleActive()
    {
        $this->is_active = !$this->is_active;
        return $this;
    }
}
