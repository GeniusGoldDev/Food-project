<?php

namespace App\Http\Controllers;

use App\User;
use Artisan;
use Hash;
use Illuminate\Http\Request;

class SchedulerController extends Controller
{
    /**
     * @param $password
     */
    public function run($password)
    {
        $admin = User::where('id', '1')->first();
        $hashedPassword = $admin->password;

        if (Hash::check($password, $hashedPassword)) {
            Artisan::call('schedule:run');
        } else {
            echo 'Access Denied.';
        }
    }
}
