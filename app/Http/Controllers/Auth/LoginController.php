<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function redirectTo()
    {

        // Admin Role
        if (Auth::user()->hasRole('Admin')) {
            return '/admin/dashboard';
        }
        // Store Owner Role
        elseif (Auth::user()->hasRole('Store Owner')) {
            return '/store-owner/dashboard';
        } elseif (Auth::user()->hasPermissionTo('dashboard_view')) {
            return '/admin/dashboard';
        } else {
            return '/admin/manager';
        }

    }

    /**
     * @param Request $request
     * @param $user
     */
    protected function authenticated(Request $request, $user)
    {
        //Check user role, if it is not admin then logout
        // if (!$user->hasRole(['Admin', 'Store Owner'])) {
        //     $this->guard()->logout();
        //     $request->session()->invalidate();
        //     return redirect('/auth/login')->withErrors('You are unauthorized to login');
        // }

        if ($user->hasRole(['Customer', 'Delivery Guy'])) {
            $this->guard()->logout();
            $request->session()->invalidate();
            return redirect('/auth/login')->withErrors('You are unauthorized to login');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        $locale = Session::get('locale');
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request, $locale) ?: redirect('/');
    }

    /**
     * @param Request $request
     */
    protected function loggedOut(Request $request, $locale)
    {
        Session::put('locale', $locale);
        return redirect()->route('get.login');
    }
}
