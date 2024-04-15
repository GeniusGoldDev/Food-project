<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordResetOtp extends Model
{
    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
